<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Payment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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

    public function create(): View
    {
        return view('pages.public.payments.edit');
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

    public function delete(Request $request): View
    {
        $group_id = $request->get('group_id');
        $group = Group::with('payments')->find($group_id);

        return view('pages.public.groups.view', [
            'group' => $group
        ]);
    }
}
