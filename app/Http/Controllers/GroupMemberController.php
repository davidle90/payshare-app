<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupMemberController extends Controller
{
    public function add_members(Request $request, $group_reference_id): JsonResponse
    {
        $group = Group::where('reference_id', $group_reference_id)->first();

        if(!$group){
            $response = [
                'status' => 0,
                'message' => 'Group not found'
            ];

            return response()->json($response);
        }

        $member_ids = $request->input('member_ids', []);
        $group->members()->syncWithoutDetaching($member_ids);

        $response = [
            'status' => 1,
            'message' => 'Member(s) added.'
        ];

        return response()->json($response);
    }

    public function remove_members(Request $request, $group_reference_id): JsonResponse
    {
        $group = Group::where('reference_id', $group_reference_id)->first();

        if(!$group){
            $response = [
                'status' => 0,
                'message' => 'Group not found'
            ];

            return response()->json($response);
        }

        $member_ids = $request->input('member_ids', []);
        $group->members()->detach($member_ids);

        $response = [
            'status' => 1,
            'message' => 'Member(s) removed.'
        ];

        return response()->json($response);
    }

    public function join_group(Request $request): JsonResponse
    {
        $group_reference_id = $request->get('group_reference_id');
        $group = Group::where('reference_id', $group_reference_id)->first();

        if(!$group){
            $response = [
                'status' => 0,
                'message' => 'Group not found'
            ];

            return response()->json($response);
        }

        $user = Auth::user();

        // add password?

        $group_member_ids = $group->members->pluck('id')->toArray();

        if(in_array($user->id, $group_member_ids)){
            $response = [
                'status' => 0,
                'message' => 'You are already a member of the group.'
            ];

            return response()->json($response);
        }

        $group->members()->syncWithoutDetaching($user->id);

        $response = [
            'status' => 1,
            'message' => 'Group joined.'
        ];

        return response()->json($response);
    }

    public function leave_group(Request $request): JsonResponse
    {
        $group_reference_id = $request->get('group_reference_id');
        $group = Group::where('reference_id', $group_reference_id)->first();

        if(!$group){
            $response = [
                'status' => 0,
                'message' => 'Group not found'
            ];

            return response()->json($response);
        }

        $user = Auth::user();

        $group_member_ids = $group->members->pluck('id')->toArray();

        if(!in_array($user->id, $group_member_ids)){
            $response = [
                'status' => 0,
                'message' => 'You are not a member of this group.'
            ];

            return response()->json($response);
        }

        $group->members()->detach($user->id);

        $response = [
            'status' => 1,
            'message' => 'You have left the group.'
        ];

        return response()->json($response);
    }
}
