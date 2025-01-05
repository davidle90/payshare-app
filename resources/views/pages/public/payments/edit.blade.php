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
        <ul class="mx-2 flex flex-col gap-2">
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
                    <button data-modal-target="paymentDeleteModal" data-modal-toggle="paymentDeleteModal" class="block text-white hover:bg-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-start">
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

                <div class="mb-4">
                    <label class="block font-bold mb-2" for="payment_label">Label</label>
                    <input class="rounded py-2 px-3 bg-slate-50" id="payment_label" type="text" required>
                </div>

                <div class="flex gap-8 mt-6">
                    <div class="bg-green-100 rounded p-4">
                        <h1 class="text-center mb-4">Contributors:</h1>
                        <div class="mb-4">
                            @foreach ($group->members as $member)
                                <div class="mb-2">
                                    <input
                                        type="checkbox"
                                        name="contributors[]"
                                        value="{{ $member->id }}"
                                        class="rounded"
                                    >
                                    <label
                                        class="ms-2 text-sm font-medium"
                                    >{{ $member->name }}</label>
                                </div>
                                <input
                                    type="number"
                                    min="0"
                                    name="contributors[]"
                                    value="{{ $member->id }}"
                                    class="text-sm rounded-lg block w-50 p-1 ml-2"
                                >
                            @endforeach
                        </div>
                    </div>
                    <div class="bg-purple-100  p-4">
                        <h1 class="text-center mb-4">Participants:</h1>
                        <div class="mb-4">
                            @foreach ($group->members as $member)
                                <div class="mb-2">
                                    <input
                                        type="checkbox"
                                        name="particpants[]"
                                        value="{{ $member->id }}"
                                        class="w-4 h-4 rounded"
                                    >
                                    <label
                                        class="ms-2 text-sm font-medium"
                                    >{{ $member->name }}</label>
                                </div>
                                <input
                                    type="number"
                                    min="0"
                                    class="text-sm rounded-lg block w-50 p-1 ml-2"
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
