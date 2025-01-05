<?php

namespace App\Helpers;

use App\Models\Contributor;
use App\Models\Debt;
use App\Models\Group;
use App\Models\Participant;
use App\Models\Payment;
use Illuminate\Support\Str;

class payshare_helpers {

    public static function update_total_expenses(Group $group)
    {
        $total_expenses = 0;

        foreach($group->payments as $payment){
            $total_expenses += $payment->total;
        }

        $group->total_expenses = $total_expenses;
        $group->save();

        return true;
    }

    public static function calculate_balance(Group $group)
    {
        $debts = [];
        $balance = [];

        foreach ($group->payments as $payment) {
            $participantsWithoutExpenses = $payment->participants()->where('amount', 0)->get();
            $participantsWithExpenses = $payment->participants()->where('amount', '>', 0)->get();

            $participantsWithoutExpensesCount = $participantsWithoutExpenses->count();
            if ($participantsWithoutExpensesCount == 0) {
                continue; // skip this payment since no one to split debt among
            }

            foreach ($payment->contributors as $contributor) {
                $debtPerMember = ($contributor->amount - $participantsWithExpenses->sum('amount')) / $participantsWithoutExpensesCount;

                foreach ($participantsWithoutExpenses as $participant) {
                    if (!isset($debts[$participant->member_id][$contributor->member_id])) {
                        $debts[$participant->member_id][$contributor->member_id] = 0;
                    }
                    if ($contributor->member_id != $participant->member_id) {
                        $debts[$participant->member_id][$contributor->member_id] += $debtPerMember;
                    }
                }

                foreach ($participantsWithExpenses as $participant) {
                    if ($contributor->member_id != $participant->member_id) {
                        $debts[$participant->member_id][$contributor->member_id] += $participant->amount;
                    }
                }
            }
        }

        foreach ($debts as $from => $debt) {
            foreach ($debt as $to => $amount) {
                if ($from != $to) {
                    if (!isset($balance[$from][$to])) {
                        $balance[$from][$to] = 0;
                    }
                    if (!isset($balance[$to][$from])) {
                        $balance[$to][$from] = 0;
                    }
                    $balance[$from][$to] += $amount;
                    $balance[$to][$from] -= $amount;
                }
            }
        }

        foreach ($balance as $from => $debtsToOthers) {
            foreach ($debtsToOthers as $to => $amount) {
                if ($from !== $to) {
                    Debt::updateOrCreate(
                        [
                            'group_id' => $group->id,
                            'from_user_id' => $from,
                            'to_user_id' => $to
                        ],
                        [
                            'amount' => (float) $amount
                        ],

                    );
                }
            }
        }

        return $balance;
    }

    public static function simplify_payment(Group $group)
    {
        // $balance = $this->calculate_balance($group);
    }

    public static function generate_reference_id($randcount, $string, $int)
    {
        $randomString = Str::random($randcount);
        $firstLetter = $string[0];
        $lastLetter = $string[strlen($string) - 1];
        $reference_id = $firstLetter . $lastLetter . $int . $randomString;

        return $reference_id;
    }

    public static function get_model($model, $reference_id)
    {
        $get_model = $model::where('reference_id', $reference_id)->first();

        if(!$get_model){
            abort(404, [
                'message' => 'Model not found',
                'error_code' => 'MODEL_NOT_FOUND',
                'reference_id' => $reference_id
            ]);
        }

        return $get_model;
    }

    public static function create_group($data)
    {
        $group = Group::create($data);
        $group->reference_id = payshare_helpers::generate_reference_id(3, $group->name, $group->id);
        $group->save();

        return $group;
    }

    public static function update_group($group, $data)
    {
        $group->name = isset($data['name']) ? $data['name'] : $group->name;
        $group->owner_id = isset($data['owner_id']) ? $data['owner_id'] : $group->owner_id;
        $group->reference_id = isset($data['reference_id']) ? $data['reference_id'] : $group->reference_id;
        $group->total_expenses = isset($data['total_expenses']) ? $data['total_expenses'] : $group->total_expenses;
        $group->is_resolved = isset($data['is_resolved']) ? $data['is_resolved'] : $group->is_resolved;
        $group->save();

        return $group;
    }

    public static function delete_group($id)
    {
        $group = Group::find($id);

        foreach($group->payments as $payment){
            $payment->contributors()->delete();
            $payment->participants()->delete();
            $payment->delete();
        }

        $group->members()->detach();
        $group->debts()->delete();
        $group->delete();
    }

    public static function create_payment($input)
    {
        $group = Group::find($input['group_id']);
        $payment = Payment::create($input);
        $payment->reference_id = payshare_helpers::generate_reference_id(3, $payment->label, $payment->id);
        $payment->save();

        foreach($input['participants'] as $participant) {
            if(!$participant['id']){
                continue;
            }

            $new_participant = Participant::firstOrNew(['member_id' => $participant['id'], 'payment_id' => $payment->id]);
            $new_participant->amount = $participant['amount'] ?? 0;
            $new_participant->save();
        }

        foreach($input['contributors'] as $contributor) {
            if(!$contributor['id']){
                continue;
            }

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

        return $payment;
    }

    public static function update_payment($input)
    {
        $group = Group::find($input['group_id']);
        $payment = Payment::find($input['payment_id']);

        $participant_ids = [];
        $contributor_ids = [];

        $payment->update($input);

        foreach($input['contributors'] as $contributor){
            if(!isset($contributor['id'])){
                continue;
            }
            $contributor_ids[] = $contributor['id'];
        }

        foreach($input['participants'] as $participant){
            if(!isset($participant['id'])){
                continue;
            }
            $participant_ids[] = $participant['id'];
        }

        foreach($payment->contributors as $payment_contributor){
            if(!in_array($payment_contributor->id, $contributor_ids)){
                $payment_contributor->delete();
            }
        }

        foreach($input['contributors'] as $contributor) {
            if(!isset($contributor['id'])){
                continue;
            }
            $new_contributor = Contributor::firstOrNew(['member_id' => $contributor['id'], 'payment_id' => $payment->id]);
            $new_contributor->amount = $contributor['amount'] ?? 0;
            $new_contributor->save();
        }

        foreach($payment->participants as $payment_participant){
            if(!in_array($payment_participant->id, $participant_ids)){
                $payment_participant->delete();
            }
        }

        foreach($input['participants'] as $participant) {
            if(!isset($participant['id'])){
                continue;
            }
            $new_participant = Participant::firstOrNew(['member_id' => $participant['id'], 'payment_id' => $payment->id]);
            $new_participant->amount = $participant['amount'] ?? 0;
            $new_participant->save();
        }

        $payment->refresh();
        $total = $payment->contributors->sum('amount');

        $payment->total = $total;
        $payment->save();

        payshare_helpers::calculate_balance($group);
        payshare_helpers::update_total_expenses($group);

        return $payment;
    }
}
