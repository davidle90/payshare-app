@extends('layouts.public.main')

@section('styles')
@endsection

@section('modals')
    @if (isset($payment))
        @include('pages.public.payments.modals.delete')
    @endif
@endsection

@section('sidebar')
    <div class="w-1/6 p-5 border-r">
        <ul class="mx-2 flex flex-col">
            <li>
                <a href="@if(isset($group)) {{ route('groups.view', ['id' => $group->id]) }} @else {{ route('groups.index') }} @endif" class="w-full block hover:bg-gray-200 font-medium text-sm px-5 py-2.5">
                    Back
                </a>
            </li>
            <li>
                <button class="onSave w-full block hover:bg-green-200 font-medium text-sm px-5 py-2.5 text-start">
                    Spara
                </button>
            </li>
            @if(isset($payment))
                <li class="mb-5">
                    <button data-modal-target="paymentDeleteModal" data-modal-toggle="paymentDeleteModal" class="w-full block hover:bg-red-200 font-medium text-sm px-5 py-2.5 text-start">
                        Ta bort
                    </button>
                </li>
            @endif
        </ul>
    </div>
@endsection

@section('content')
    <div class="container mx-auto p-5">
        <div>
            <form id="onSaveForm" action="{{ route('payments.store') }}" method="POST" autocomplete="off">
                @csrf

                <input type="hidden" name="group_id" value="{{ $group->id }}">
                <input type="hidden" name="payment_id" value="{{ $payment->id ?? '' }}">

                <div class="mb-4">
                    <label class="block font-bold mb-2" for="label">Label</label>
                    <input class="rounded py-2 px-3 bg-slate-50" name="label" id="label" type="text" value="{{ $payment->label ?? '' }}" required>
                </div>

                <div class="flex gap-8 mt-6">
                    <div class="bg-green-100 rounded p-4">
                        <h1 class="text-center mb-4">Contributors:</h1>
                        <div class="mb-4">
                            @foreach ($group->members as $key => $member)
                                <div class="mb-2">
                                    <input
                                        type="checkbox"
                                        name="contributors[{{ $key }}][id]"
                                        value="{{ $member->id }}"
                                        class="rounded"
                                        @if (isset($payment) && $payment->contributors->contains('member_id', $member->id))
                                            checked
                                        @endif
                                    >
                                    <label
                                        class="ms-2 text-sm font-medium"
                                    >{{ $member->name }}</label>
                                </div>
                                <input
                                    type="number"
                                    min="0"
                                    name="contributors[{{ $key }}][amount]"
                                    class="text-sm rounded-lg block w-50 p-1 ml-2"
                                    @if (isset($payment) && $payment->contributors->contains('member_id', $member->id))
                                            value="{{ $payment->contributors()->where('member_id', $member->id)->first()->amount }}"
                                    @endif
                                >
                            @endforeach
                        </div>
                    </div>
                    <div class="bg-purple-100  p-4">
                        <h1 class="text-center mb-4">Participants:</h1>
                        <div class="mb-4">
                            @foreach ($group->members as $key => $member)
                                <div class="mb-2">
                                    <input
                                        type="checkbox"
                                        name="participants[{{ $key }}][id]"
                                        value="{{ $member->id }}"
                                        class="w-4 h-4 rounded"
                                        @if (isset($payment) && $payment->participants->contains('member_id', $member->id))
                                            checked
                                        @endif
                                    >
                                    <label
                                        class="ms-2 text-sm font-medium"
                                    >{{ $member->name }}</label>
                                </div>
                                <input
                                    type="number"
                                    min="0"
                                    name="participants[{{ $key }}][amount]"
                                    class="text-sm rounded-lg block w-50 p-1 ml-2"
                                    @if (isset($payment) && $payment->participants->contains('member_id', $member->id))
                                            value="{{ $payment->participants()->where('member_id', $member->id)->first()->amount }}"
                                    @endif
                                >
                            @endforeach
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    @include('includes.scripts.go-to-url')
    @include('includes.scripts.form')
@endsection
