<?php

namespace App\Http\Controllers;

use App\Helpers\payshare_helpers;
use App\Models\Group;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class GroupController extends Controller
{
    public function index(): View
    {
        $groups = auth()->user()->groups;

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
        $input = [
            'id' => $request->input('group_id'),
            'name' => $request->input('name'),
            'owner_id' => auth()->user()->id,
            'is_resolved' => $request->get('is_resolved', false)
        ];

        DB::beginTransaction();

        try {

            $group = Group::find($input['id']);

            if(!$group){
                $group = payshare_helpers::create_group($input);

                $response = [
                    'status' => 1,
                    'redirect' => route('groups.edit', ['id' => $group->id]),
                    'message' => 'Group has been created.'
                ];

                $group->members()->syncWithoutDetaching($group->owner_id);

            } else {
                $group = payshare_helpers::update_group($group, $input);

                $response = [
                    'status' => 1,
                    'message' => 'Group has been updated.'
                ];
            }

            DB::commit();

            $request->session()->put('action_message', $response['message']);

        } catch (Exception $e) {

            DB::rollback();

            $response = [
                'status' => 0,
                'message' => 'Error while saving group.',
                'error' => $e->getMessage()
            ];
        }

        return response()->json($response);
    }

    public function delete(Request $request): JsonResponse
    {
        $id = $request->get('delete_id');

        try {
            DB::beginTransaction();

            payshare_helpers::delete_group($id);

            DB::commit();

            $response = [
                'status' => 1,
                'message' => 'Group has been deleted.',
                'redirect' => route('groups.index')
            ];

            $request->session()->put('action_message', $response['message']);

        } catch (Exception $e) {
            DB::rollback();

            $response = [
                'status' => 0,
                'message' => 'Error while deleting group.'
            ];
        }

        return response()->json($response);
    }
}
