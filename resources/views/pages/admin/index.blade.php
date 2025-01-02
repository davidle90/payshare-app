@extends('layouts.admin.main')

@section('styles')
@endsection

@section('modals')
@endsection

@section('breadcrumbs')
@endsection

@section('content')
<div class="p-5">
    <div class="py-5 mb-5">
        <ul>
            @foreach($inquiries as $inquiry)
                <li>
                    <a href="{{ route('admin.inquiries.view', ['id' => $inquiry->id]) }}">{{ $inquiry->name }} - {{ $inquiry->email }}</a>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
        <div class="cursor-pointer go-to-url max-w-sm rounded overflow-hidden shadow-lg bg-gray-50" data-url="{{ route('admin.blog.index') }}">
            <div class="px-6 py-4">
                <div class="font-bold text-xl mb-2">Blog</div>
                <p class="text-gray-700 text-base">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla! Maiores et perferendis eaque, exercitationem praesentium nihil.
                </p>
            </div>
        </div>

        <div class="cursor-pointer go-to-url max-w-sm rounded overflow-hidden shadow-lg bg-gray-50" data-url="{{ route('admin.categories.index') }}">
            <div class="px-6 py-4">
                <div class="font-bold text-xl mb-2">Categories</div>
                <p class="text-gray-700 text-base">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla! Maiores et perferendis eaque, exercitationem praesentium nihil.
                </p>
            </div>
        </div>

        <div class="cursor-pointer go-to-url max-w-sm rounded overflow-hidden shadow-lg bg-gray-50" data-url="{{ route('admin.settings.index') }}">
            <div class="px-6 py-4">
                <div class="font-bold text-xl mb-2">Settings</div>
                <p class="text-gray-700 text-base">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla! Maiores et perferendis eaque, exercitationem praesentium nihil.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    @include('includes.scripts.go-to-url')
@endsection
