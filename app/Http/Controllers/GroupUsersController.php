<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GroupUsers;
use App\Models\Group;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class GroupUsersController extends Controller
{
    public function store(Request $request)
    {
        $groups = Group::pluck('id')->toArray();
       
        $rules = [
            'groupId' => ['required', Rule::in($groups)],
        ];

        $messages = [
            'groupId.required' => 'El "Grupo" es obligatorio.',
            'groupId.in'       => 'Seleccione un "Grupo" valido.',
        ];

        $request->validate($rules, $messages);
       
        GroupUsers::create([
            'group_id' => $request->groupId,
            'user_id'  => Auth::user()->id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Te uniste al grupo exitosamente',
        ]);
    }
}
