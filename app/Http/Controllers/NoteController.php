<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GroupUsers;
use App\Models\Group;
use App\Models\Note;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Mail\NotificationNoteMail;
use Illuminate\Support\Facades\Mail;

class NoteController extends Controller
{
    public function index(Group $group, Request $request)
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

    public function store(Group $group, Request $request)
    {
        $rules = [
            'title'       => 'required',
            'description' => 'required',
        ];

        $messages = [
            'title.required'       => 'El "Titulo" es obligatorio.',
            'description.required' => 'La "Descripción" es obligatorio.',
        ];

        $request->validate($rules, $messages);

        $groupUserAuth = GroupUsers::where([
            ['group_id', $group->id],
            ['user_id', Auth::user()->id]
        ])->first();

        if (is_null($groupUserAuth)) {
            return response()->json([
                'error'   => true,
                'message' => 'Aun no te uniste a este grupo.',
            ]);
        }

        $note = Note::create([
            'title'          => $request->title,
            'description'    => $request->description,
            'group_users_id' => $groupUserAuth->id,
            'img'            => $this->uploadFile($request) ?? '',
        ]);
        
        if ($note) {
            $this->sendEmailNotification($request);
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Nota registrado correctamente.',
        ]);
    }

    public function uploadFile(Request $request) 
    {
        $pathImgPerfil = '';
        
        if ($request->hasFile('img')) {
            $pathImgPerfil = Storage::putFile('public/images/note', $request->file('img'));
        
        }

        return $pathImgPerfil;
    }

    public function sendEmailNotification(Request $request) 
    {
        $groupUsers = GroupUsers::join('users', 'users.id', 'group_users.user_id')
                        ->where('group_id', $request->group_id)->get();


        foreach($groupUsers as $to) {
            Mail::to($to->email)
                ->send(new NotificationNoteMail($groupUserAuth->name, $request->title));
        }
    }
}
