@extends('layouts.public.main')

@section('styles')
@endsection

@section('modals')
@endsection

@section('sidebar')
    <div class="w-1/6 p-5 border-r">
        <ul class="mx-2 flex flex-col">
            <li>
                <a href="{{ route('groups.create') }}" class="w-full block hover:bg-green-200 font-medium text-sm px-5 py-2.5">
                    Create group
                </a>
            </li>
            <li>
                <a href="#" class="w-full block hover:bg-gray-200 font-medium text-sm px-5 py-2.5">Join group</a>
            </li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="container mx-auto p-5">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 border">
            <thead class="font-bold text-white uppercase bg-cyan-600">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Group Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Total expenses
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Your expenses
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Created by
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Created at
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Latest activity
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($groups as $group)
                    <tr class="go-to-url cursor-pointer bg-white border-b" data-url="{{ route('groups.view', ['id' => $group->id]) }}">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            {{ $group->name }}
                        </th>
                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            {{ $group->total_expenses }}
                        </td>
                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            todo
                        </td>
                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            {{ $group->is_resolved ? 'Resolved' : 'Active' }}
                        </td>
                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            {{ $group->owner->name }}
                        </td>
                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            {{ $group->created_at }}
                        </td>
                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            {{ $group->updated_at }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
    @include('includes.scripts.go-to-url')
@endsection
