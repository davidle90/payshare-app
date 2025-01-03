@extends('layouts.public.main')

@section('styles')
@endsection

@section('modals')
@endsection

@section('content')
    <div class="container mx-auto py-5">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 border">
            <thead class="font-bold text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Payment name
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($group->payments as $payment)
                    <tr class="go-to-url cursor-pointer bg-white border-b" data-url="{{ route('payments.view', ['id' => $payment->id]) }}">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            {{ $payment->name }}
                        </th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
    @include('includes.scripts.go-to-url')
@endsection
