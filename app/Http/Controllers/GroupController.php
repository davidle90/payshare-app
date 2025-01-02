<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GroupController extends Controller
{
    public function index(): View
    {
        $groups = auth()->user->groups;

        return view('pages.public.groups.index', [
            'groups' => $groups
        ]);
    }

    public function view($id): View
    {
        $group = Group::with('payments')->find($id);

        return view('pages.public.groups.view', [
            'group' => $group
        ]);
    }

    public function create(): View
    {
        return view('pages.public.groups.edit');
    }

    public function edit($id): View
    {
        $group = Group::find($id);

        return view('pages.public.groups.edit', [
            'group' => $group
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        return response()->json();
    }

    public function delete(Request $request): View
    {
        $groups = auth()->user->groups;

        return view('pages.public.groups.index', [
            'groups' => $groups
        ]);
    }
}
