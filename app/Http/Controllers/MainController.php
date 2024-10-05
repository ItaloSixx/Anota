<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use App\Services\Operations;
use Illuminate\Http\Request;


class MainController extends Controller
{
    public function index(){
        //load notes
        $id = session('user.id');
        $user = User::find($id)->toArray();
        $notes = User::find($id)
                       ->notes()
                       ->whereNull('deleted_at')
                       ->get()
                       ->toArray();

        return view('home', ['notes' => $notes]);

    }

    public function newNote(){
        return view('new_note');
    }




    public function newNoteSubmit(Request $request){
        $request->validate(
            //rules
            [
                'text_title' => 'required|min:1|max:200',
                'text_note' => 'required|min:1|max:3000'
            ],
            //errors messages
            [
                'text_title.required' => 'O titulo não pode ser vazio',
                'text_title.min' => 'O titulo deve ter no mínimo :min caracteres',
                'text_title.max' => 'O titulo deve ter no máximo :max caracteres',

                'text_note.required' => 'A nota não pode ser vazia',
                'text_note.min' => 'A nota deve ter no mínimo :min caracteres',
                'text_note.max' => 'A nota deve ter no máximo :max caracteres'

            ]
        );

        //catch actually user
        $id = session('user.id');

        //create new note
        $note = new Note();
        $note->user_id = $id;
        $note->title = $request->text_title;
        $note->text = $request->text_note;
        $note->save();

        //redirect to home
        return redirect()->route('home');


    }



    public function editNote($id){
        $id = Operations::decryptId($id);

        //load note
        $note = Note::find($id);
        //show edit view and pass note information
        return view('edit_note', ['note' => $note]);
    }

    public function editNoteSubmit(Request $request){
        //validade
        // validate request
        $request->validate(
            // rules
            [
                'text_title' => 'required|min:1|max:200',
                'text_note' => 'required|min:1|max:3000'
            ],
            // error messages
            [
                'text_title.required' => 'O título é obrigatório',
                'text_title.min' => 'O título deve ter pelo menos :min caracteres',
                'text_title.max' => 'O título deve ter no máximo :max caracteres',
                'text_note.required' => 'A nota é obrigatória',
                'text_note.min' => 'A nota deve ter pelo menos :min caracteres',
                'text_note.max' => 'A nota deve ter no máximo :max caracteres'
            ]
        );
        //check if note_id exist
        if($request->note_id == null){
            return redirect()->route('home');
        }

        //decrypt note_id
        $id = Operations::decryptId($request->note_id);
        //load note
        $note = Note::find($id);
        //update note
        $note->title = $request->text_title;
        $note->text = $request->text_note;
        $note->save();
        //redirect
        return redirect()->route('home');
    }




    public function deleteNote($id){
        $id = Operations::decryptId($id);

        //load note
        $note = Note::find($id);

        //show delete note confirmation
        return view('delete_note', ['note' => $note]);
    }

    public function deleteNoteConfirm($id){
        //check if $id encrypted
        $id = Operations::decryptId($id);

        //load note
        $note = Note::find($id);

        //soft delete (property in model)
        $note->delete();

        //hard delete (property SoftDelete in model)
        //$note->forceDelete();

        //redirect
        return redirect()->route('home');
    }

}
