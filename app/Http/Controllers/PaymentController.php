<?php

namespace App\Http\Controllers;

use App\Helpers\payshare_helpers;
use App\Models\Group;
use App\Models\Payment;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PaymentController extends Controller
{
    public function view($id): View
    {
        $payment = Payment::find($id);

        return view('pages.public.payments.view', [
            'payment' => $payment
        ]);
    }

    public function create($group_id): View
    {
        $group = Group::find($group_id);
        return view('pages.public.payments.edit', [
            'group' => $group
        ]);
    }

    public function edit($id): View
    {
        $payment = Payment::find($id);

        return view('pages.public.payments.edit', [
            'payment' => $payment
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        return response()->json();
    }

    public function delete(Request $request): JsonResponse
    {
        $group_id = $request->get('group_id');
        $payment_id = $request->get('payment_id');

        $group = Group::find($group_id);
        $payment = Payment::find($payment_id);

        try {
            DB::beginTransaction();

            $payment->contributors()->delete();
            $payment->participants()->delete();
            $payment->delete();

            payshare_helpers::calculate_balance($group);
            payshare_helpers::update_total_expenses($group);

            DB::commit();

            $response = [
                'status' => 1,
                'message' => 'Payment has been deleted.',
                'redirect' => route('groups.index')
            ];

            $request->session()->put('action_message', $response['message']);

        } catch (Exception $e) {
            DB::rollback();

            $response = [
                'status' => 0,
                'message' => 'Error while deleting payment.'
            ];
        }

        return response()->json($response);
    }
}
