@extends('layouts.public.main')

@section('styles')
@endsection

@section('modals')
    @if(isset($group))
        @include('pages.public.groups.modals.delete')
    @endif
@endsection

@section('content')
    <div class="container mx-auto py-5">
        <form id="onSaveForm" action="{{ route('groups.store') }}" method="POST" class="max-w-sm" autocomplete="off">
            @csrf

            <input type="hidden" name="id" value="{{ $group->id ?? '' }}">

            <div class="mb-5">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Group name</label>
                <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" value="{{ $group->name ?? '' }}" />
            </div>
        </form>

        <ul class="flex text-gray-900">
            <li class="mb-5 mr-2">
                <button class="onSave block text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="button">
                    Spara
                </button>
            </li>
            @if(isset($group))
                <li class="mb-5">
                    <button data-modal-target="groupDeleteModal" data-modal-toggle="groupDeleteModal" class="block text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="button">
                        Ta bort
                    </button>
                </li>
            @endif
        </ul>
    </div>
@endsection

@section('scripts')
    @include('includes.scripts.go-to-url')
    @include('includes.scripts.form')
@endsection
