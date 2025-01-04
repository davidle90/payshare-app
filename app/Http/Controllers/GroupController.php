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
            'id' => $request->input('id'),
            'name' => $request->input('name')
        ];

        //TODO: Validate

        try {
            DB::beginTransaction();

            $group = Group::firstOrNew(['id' => $input['id']]);

            $group->name = $input['name'];
            $group->owner_id = auth()->user()->id;
            $group->reference_id = payshare_helpers::generate_reference_id(3, $group->name, $group->id);

            $group->save();

            $group->members()->attach($group->owner_id);

            DB::commit();

            $response = [
                'status' => 1,
                'message' => 'Group has been created.'
            ];

        } catch (Exception $e) {

            DB::rollback();

            $response = [
                'status' => 0,
                'message' => 'Error while saving group.'
            ];
        }

        return response()->json($response);
    }

    public function delete(Request $request): View
    {
        $groups = auth()->user->groups;

        $id = $request->get('id');

        try {
            DB::beginTransaction();

            $group = Group::find($id);

            foreach($group->payments as $payment){
                $payment->contributors()->delete();
                $payment->participants()->delete();
                $payment->delete();
            }

            $group->members()->detach();
            $group->debts()->delete();
            $group->delete();

            DB::commit();

            $response = [
                'status' => 0,
                'message' => 'Group has been deleted.'
            ];

        } catch (Exception $e) {
            DB::rollback();

            $response = [
                'status' => 0,
                'message' => 'Error while deleting group.'
            ];
        }

        return view('pages.public.groups.index', [
            'groups' => $groups
        ]);
    }
}
