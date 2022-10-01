<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\GroupUsers;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    public function index() 
    {
        $groups = Group::all();

        return response()->json([
            'success' => true,
            'data'    => $groups,
        ]); 
    }

    public function show(Group $group) 
    {
        $existGroupUser = GroupUsers::where([
            ['group_id', $group->id],
            ['user_id', Auth::user()->id]
        ])->exists();

        if (!$existGroupUser) {
            return response()->json([
                'error'    => true,
                'messasge' => 'No te has unido aun a este grupo',
            ]);
        }

        $notes = GroupUsers::join('notes', 'notes.group_users_id', 'group_users.id')
            ->where([
                ['group_id', $group->id],
                ['user_id', Auth::user()->id]
            ])
            ->select(
                'notes.id as id_note', 
                'notes.title as title_note', 
                'notes.description as description_note', 
                'notes.img as img_note'
            )
            ->get();

        return response()->json([
            'success' => true,
            'group'   => $group,
            'notes'   => $notes,
        ]);
    }
}
