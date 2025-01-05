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
        $input = [
            'group_id' => $request->get('group_id'),
            'created_by' => auth()->user()->id,
            'participants' => $request->get('participants'),
            'contributors' => $request->get('contributors')
        ];

        dd($input);

        try {
            DB::beginTransaction();

            $group = Group::find($input['group_id']);

            $payment = Payment::create($input);
            $payment->reference_id = payshare_helpers::generate_reference_id(3, $payment->label, $payment->id);
            $payment->save();

            foreach($input['participants'] as $participant) {
                $new_participant = Participant::firstOrNew(['member_id' => $participant['id'], 'payment_id' => $payment->id]);
                $new_participant->amount = $participant['amount'] ?? 0;
                $new_participant->save();
            }

            foreach($input['contributors'] as $contributor) {
                $new_contributor = Contributor::firstOrNew(['member_id' => $contributor['id'], 'payment_id' => $payment->id]);
                $new_contributor->amount = $contributor['amount'] ?? 0;
                $new_contributor->save();
            }

            $total = 0;
            foreach($payment->contributors as $payment_contributor){
                $total += $payment_contributor->amount;
            }

            $payment->total = $total;
            $payment->reference_id = payshare_helpers::generate_reference_id(5, $payment->label, $payment->id);
            $payment->save();

            payshare_helpers::calculate_balance($group);
            payshare_helpers::update_total_expenses($group);

            DB::commit();

            $response = [
                'status' => 1,
                'message' => 'Payment has been saved.'
            ];
        } catch (Exception $e) {
            DB::rollback();

            $response = [
                'status' => 0,
                'message' => 'Error while saving payment.'
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
