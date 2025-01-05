@extends('layouts.public.main')

@section('styles')
@endsection

@section('modals')
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
                <a href="{{ route('payments.edit', ['group_id' => $group->id, 'payment_id' => $payment->id]) }}" class="w-full block hover:bg-gray-200 font-medium text-sm px-5 py-2.5">
                    Edit
                </a>
            </li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="container mx-auto p-5">
        <div class="text-center text-2xl mb-5">
            {{ $payment->label }}
        </div>
        <div class="mb-5">
            <h2>Contributors</h2>
            @foreach ($payment->contributors as $contributor)
                {{ $contributor->member->name }} <span class="font-bold">paid:</span> {{ $contributor->amount }} SEK
            @endforeach
        </div>
        <div>
            <h2>Participants</h2>
            @foreach ($payment->participants as $participant)
                {{ $participant->member->name }} <span class="font-bold">amount:</span> {{ $participant->amount }} SEK
            @endforeach
        </div>
    </div>
@endsection

@section('scripts')
    @include('includes.scripts.go-to-url')
@endsection
