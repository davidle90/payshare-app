@extends('layouts.admin.main')

@section('styles')
@endsection

@section('modals')
@endsection

@section('breadcrumbs')
    <li aria-current="page">
        <div class="flex items-center">
            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
            </svg>
            <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2">Inställningar</span>
        </div>
    </li>
@endsection

@section('content')
    <div class="m-5">
        <h1 class="mb-5 font-bold">Inställningar</h2>
        <form id="onSaveForm" action="{{ route('admin.settings.store') }}" method="POST">
            @csrf

            <div class="border rounded p-5 bg-gray-50 mb-3">
                <div class="mb-3">
                    <label class="block mb-5 text-sm font-medium font-semibold text-gray-900">Kontaktinformation</label>

                    <div class="mb-5">
                        <label for="my_page" class="block mb-2 text-sm text-gray-900">Min sida</label>
                        <input type="text" name="my_page" value="{{ $settings['my_page'] ?? '' }}" class="border border-gray-300 text-gray-900 text-sm rounded-lg block w-64 p-2.5" />
                    </div>

                    <div class="mb-5">
                        <label for="email" class="block mb-2 text-sm text-gray-900">E-post</label>
                        <input type="text" name="email" value="{{ $settings['email'] ?? '' }}" class="border border-gray-300 text-gray-900 text-sm rounded-lg block w-64 p-2.5" />
                    </div>

                    <div class="mb-5">
                        <label for="linkedin" class="block mb-2 text-sm text-gray-900">LinkedIn</label>
                        <input type="text" name="linkedin" value="{{ $settings['linkedin'] ?? '' }}" class="border border-gray-300 text-gray-900 text-sm rounded-lg block w-64 p-2.5" />
                    </div>

                    <div>
                        <label for="github" class="block mb-2 text-sm text-gray-900">GitHub</label>
                        <input type="text" name="github" value="{{ $settings['github'] ?? '' }}" class="border border-gray-300 text-gray-900 text-sm rounded-lg block w-64 p-2.5" />
                    </div>
                </div>
            </div>
        </form>

        <button class="onSave block text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="button">
            Spara
        </button>
        <div class="action-message mt-3">
        </div>
    </div>
@endsection

@section('scripts')
    @include('settings::includes.scripts.form')
@endsection
