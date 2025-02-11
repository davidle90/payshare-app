<?php

namespace App\Http\Controllers;

use App\Helpers\payshare_helpers;
use App\Models\Contributor;
use App\Models\Group;
use App\Models\Participant;
use App\Models\Payment;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PaymentController extends Controller
{
    public function view($group_id, $payment_id): View
    {
        $group = Group::find($group_id);
        $payment = Payment::find($payment_id);

        return view('pages.public.payments.view', [
            'payment' => $payment,
            'group' => $group
        ]);
    }

    public function create($group_id): View
    {
        $group = Group::find($group_id);
        return view('pages.public.payments.edit', [
            'group' => $group
        ]);
    }

    public function edit($group_id, $payment_id): View
    {
        $group = Group::find($group_id);
        $payment = Payment::find($payment_id);

        return view('pages.public.payments.edit', [
            'payment' => $payment,
            'group' => $group
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $input = [
            'payment_id' => $request->get('payment_id'),
            'group_id' => $request->get('group_id'),
            'created_by' => auth()->user()->id,
            'label' => $request->get('label'),
            'participants' => $request->get('participants'),
            'contributors' => $request->get('contributors')
        ];

        try {
            DB::beginTransaction();

            $payment = Payment::find($input['payment_id']);

            if(!$payment){
                payshare_helpers::create_payment($input);
            } else {
                payshare_helpers::update_payment($input);
            }

            DB::commit();

            $response = [
                'status' => 1,
                'message' => 'Payment has been saved.'
            ];
        } catch (Exception $e) {
            DB::rollback();

            $response = [
                'status' => 0,
                'message' => 'Error while saving payment.',
                'error' => $e->getMessage()
            ];
        }

        return response()->json($response);
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
