<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GroupUsers;
use Illuminate\Support\Facades\Auth;

class GroupUsersController extends Controller
{
    public function store(Request $request)
    {
        GroupUsers::create([
            'group_id' => $request->group_id,
            'user_id'  => Auth::user()->id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Te uniste al grupo exitosamente',
        ]);
    }
}
