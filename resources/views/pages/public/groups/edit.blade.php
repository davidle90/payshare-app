@extends('layouts.public.main')

@section('styles')
@endsection

@section('modals')
    @if(isset($group))
        @include('pages.public.groups.modals.delete')
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
            @if(isset($group))
                <li>
                    <button data-modal-target="groupDeleteModal" data-modal-toggle="groupDeleteModal" class="w-full block hover:bg-red-200 font-medium text-sm px-5 py-2.5 text-start">
                        Ta bort
                    </button>
                </li>
            @endif
        </ul>
    </div>
@endsection

@section('content')
    <div class="container mx-auto p-5">
        <form id="onSaveForm" action="{{ route('groups.store') }}" method="POST" class="max-w-sm" autocomplete="off">
            @csrf

            <input type="hidden" name="id" value="{{ $group->id ?? '' }}">

            <div class="mb-5">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Group name</label>
                <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" value="{{ $group->name ?? '' }}" />
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    @include('includes.scripts.go-to-url')
    @include('includes.scripts.form')
@endsection
