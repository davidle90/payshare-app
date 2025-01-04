@extends('layouts.public.main')

@section('styles')
@endsection

@section('modals')
@endsection

@section('content')
    <div class="container mx-auto py-5">
        <form action="{{ route('groups.store') }}" method="POST">
            @csrf

            <input type="hidden" name="id" value="{{ $group->id ?? '' }}">

            <div class="mb-5">
                <label for="name" class="block mb-2">Group name</label>
                <input type="text" name="name" id="name" value="{{ $group->name ?? '' }}" />
            </div>

            <div class="flex gap-4">
                <button type="submit" class="px-3 py-2 text-white bg-green-600 hover:bg-green-700">Save</button>
            </div>
        </form>
        @if(isset($group))
            <button class="px-3 py-2 text-white bg-red-600 hover:bg-red-700">Delete</button>
        @endif
    </div>
@endsection

@section('scripts')
    @include('includes.scripts.go-to-url')
@endsection
