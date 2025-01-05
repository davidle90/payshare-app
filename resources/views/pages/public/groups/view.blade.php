@extends('layouts.public.main')

@section('styles')
@endsection

@section('modals')
@endsection

@section('content')
    <div class="container mx-auto py-5">
        <div class="mb-5">
            <div>
                {{ $group->name }}
            </div>
            <div>
                ID: {{ $group->reference_id }}
            </div>

        </div>


        <div class="flex justify-between mb-3 sm:mb-0">
            <div class="mb-5">
                <a href="{{ route('groups.index') }}" class="border px-3 py-1 bg-gray-200 hover:bg-gray-300">Back</a>
                <a href="{{ route('groups.edit', ['id' => $group->id]) }}" class="px-3 py-1 text-white bg-green-600 hover:bg-green-700">Edit</a>
            </div>
            <div class="sm:flex justify-end space-y-4 sm:space-y-0">
                <div>
                    <a href="{{ route('payments.create', ['group_id' => $group->id]) }}" class="border px-3 py-1 hover:bg-gray-300">Add payment</a>
                </div>
                <div>
                    <span class="cursor-pointer border px-3 py-1 hover:bg-gray-300">Charts</span>
                </div>
                <div>
                    <span class="cursor-pointer border px-3 py-1 hover:bg-gray-300">Resolve</span>
                </div>
                <div>
                    <span class="cursor-pointer border px-3 py-1 bg-purple-300 hover:bg-purple-400">Leave group</span>
                </div>
            </div>
        </div>

        <table class="w-full text-sm text-left rtl:text-right text-gray-500 border">
            <thead class="font-bold text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">Date</th>
                    <th scope="col" class="px-6 py-3">Label</th>
                    <th scope="col" class="px-6 py-3">Total</th>
                    <th scope="col" class="px-6 py-3">Created by</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($group->payments as $payment)
                    <tr class="go-to-url cursor-pointer bg-white border-b" data-url="{{ route('payments.view', ['id' => $payment->id]) }}">
                        <td class="px-6 py-4">{{ $payment->created_at }}</td>
                        <td class="px-6 py-4">{{ $payment->label }}</td>
                        <td class="px-6 py-4">{{ $payment->total }}</td>
                        <td class="px-6 py-4">{{ $payment->created_by }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
    @include('includes.scripts.go-to-url')
@endsection
