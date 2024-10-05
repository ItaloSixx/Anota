<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class MainController extends Controller
{
    public function index(){
        //load notes
        $id = session('user.id');
        $user = User::find($id)->toArray();
        $notes = User::find($id)
                       ->notes()
                       ->get()
                       ->toArray();

        return view('home', ['notes' => $notes]);

    }

    public function newNote(){
        echo 'criando uma nova nota';
    }

    public function editNote($id){
        $id = $this->decryptId($id);
        echo "editando not a $id";
    }

    public function deleteNote($id){
        $id = $this->decryptId($id);
    }
    //decryptar id
    private function decryptId($id){
        try {
            $id = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            return redirect()->route('home');
        }
        return $id;
    }
}
