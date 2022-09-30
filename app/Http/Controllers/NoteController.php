<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GroupUsers;
use App\Models\Note;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NoteController extends Controller
{
    public function index(Request $request)
    {
        $notes = Note::orderBy('id', 'DESC')
            ->creationDate($request->first_date, $request->last_date)
            ->imgExist($request->img)
            ->get();

        return response()->json([
            'success' => true,
            'data'    => $notes,
        ]);
    }

    public function store(Request $request)
    {
        $groupUserAuth = GroupUsers::where([
            ['group_id', $request->group_id],
            ['user_id', Auth::user()->id]
        ])->first();
        
        Note::create([
            'title'          => $request->title,
            'description'    => $request->description,
            'group_users_id' => $groupUserAuth->id,
            'img'            => $this->uploadFile($request),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Nota registrado correctamente.',
        ]);
    }

    public function uploadFile(Request $request) 
    {
        if ($request->hasFile('imgNote')) {
            $pathImgPerfil = Storage::putFile('public/images/note', $request->file('imgNote'));
        }

        return $pathImgPerfil;
    }
}
