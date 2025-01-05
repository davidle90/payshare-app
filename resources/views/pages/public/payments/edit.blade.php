@extends('layouts.public.main')

@section('styles')
@endsection

@section('modals')
@endsection

@section('content')
    <div class="container mx-auto py-5">
        <div>
            <form action="" method="" autocomplete="off">
                <div class="mb-4">
                    <label class="block font-bold mb-2" for="payment_label">Label</label>
                    <input class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="payment_label" type="text" required>
                </div>

                <div class="flex gap-8 mt-6">
                    <div class="border p-4">
                        <h1 class="text-center mb-4">Contributors:</h1>
                        <div class="mb-4">
                            @foreach ($group->members as $member)
                                <div>
                                    <input
                                        type="checkbox"
                                        value="{{ $member->id }}"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded"
                                    >
                                    <label
                                        class="ms-2 text-sm font-medium"
                                    >{{ $member->name }}</label>
                                </div>
                                <input
                                    type="number"
                                    min="0"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-50 p-1 ml-2"
                                >
                            @endforeach
                        </div>
                    </div>
                    <div class="border p-4">
                        <h1 class="text-center mb-4">Particpants:</h1>
                        <div class="mb-4">
                            @foreach ($group->members as $member)
                                <div>
                                    <input
                                        type="checkbox"
                                        value="{{ $member->id }}"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded"
                                    >
                                    <label
                                        class="ms-2 text-sm font-medium"
                                    >{{ $member->name }}</label>
                                </div>
                                <input
                                    type="number"
                                    min="0"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-50 p-1 ml-2"
                                >
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="mt-6">
                    <ul class="flex text-gray-900">
                        <li class="mb-5 mr-2">
                            <button class="onSave block text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="button">
                                Spara
                            </button>
                        </li>
                        @if(isset($payment))
                            <li class="mb-5">
                                <button data-modal-target="paymentDeleteModal" data-modal-toggle="paymentDeleteModal" class="block text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="button">
                                    Ta bort
                                </button>
                            </li>
                        @endif
                    </ul>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    @include('includes.scripts.go-to-url')
@endsection
