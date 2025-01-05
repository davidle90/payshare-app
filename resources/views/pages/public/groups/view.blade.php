@extends('layouts.public.main')

@section('styles')
@endsection

@section('modals')
@endsection

@section('sidebar')
    <div class="w-1/6 p-5 border-r">
        <ul class="mx-2 flex flex-col">
            <li>
                <a href="{{ route('groups.index') }}" class="w-full block hover:bg-gray-200 font-medium text-sm px-5 py-2.5">Back</a>
            </li>
            <li>
                <a href="{{ route('groups.edit', ['id' => $group->id]) }}" class="w-full block hover:bg-gray-200 font-medium text-sm px-5 py-2.5">Edit</a>
            </li>
            <li>
                <a href="{{ route('groups.index') }}" class="w-full block hover:bg-green-200 font-medium text-sm px-5 py-2.5">Add member</a>
            </li>
            <li>
                <a href="{{ route('groups.index') }}" class="w-full block hover:bg-red-200 font-medium text-sm px-5 py-2.5">Leave group</a>
            </li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="container mx-auto p-5">
        <div class="mb-5">
            <h1 class="text-3xl font-semibold mb-2">{{ $group->name }}</h1>
            <div class="text-lg">
                ID: {{ $group->reference_id }}
            </div>
        </div>

        <div class="flex justify-between mb-2">
            <div class="sm:flex justify-end space-y-4 sm:space-y-0">
                <div>
                    <a href="{{ route('payments.create', ['group_id' => $group->id]) }}" class="border px-3 py-1 bg-green-200 hover:bg-green-300">Add payment</a>
                </div>
                <div>
                    <span class="cursor-pointer border px-3 py-1 hover:bg-gray-300">Charts</span>
                </div>
                <div>
                    <span class="cursor-pointer border px-3 py-1 hover:bg-gray-300">Resolve</span>
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
                    <tr class="go-to-url cursor-pointer bg-white border-b" data-url="{{ route('payments.view', ['group_id' => $group->id, 'payment_id' => $payment->id]) }}">
                        <td class="px-6 py-4">{{ $payment->created_at }}</td>
                        <td class="px-6 py-4">{{ $payment->label }}</td>
                        <td class="px-6 py-4">{{ $payment->total }}</td>
                        <td class="px-6 py-4">{{ $payment->createdBy->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
    @include('includes.scripts.go-to-url')
@endsection
