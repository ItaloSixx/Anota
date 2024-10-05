<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDOException;

class AuthController extends Controller
{
    public function login(){
        return view('login');
    }

    //processes the login form submission
    public function loginSubmit(Request $request){
        //validation form
        $request->validate(
            //rules
            [
                'text_username' => 'required|email',
                'text_password' => 'required|min:8|max:22'
            ],
            //errors
            [
                'text_username.required' => 'Necessário preencher o email',
                'text_username.email' => 'Precisa ser um email válido',
                'text_password.required' => 'Necessário preencher a senha',
                'text_password.min' => 'Minimo de :min caracteres',
                'text_password.max' => 'Maximo de :max caracteres'

            ]
        );
        $username = $request->input('text_username');
        $password = $request->input('text_password');

        //queries the database for a user with the given username
        $user = User::where('username', $username)
                        ->where('deleted_at', NULL)
                        ->first();

        //if user is not found, redirects back with an error message
        if(!$user){
            return redirect()
                    ->back()
                    ->withInput()
                    ->with('loginError', 'Usuário não encontrado');
        }

        //passoword check
        if(!password_verify($password, $user->password)){
            return redirect()
                    ->back()
                    ->withInput()
                    ->with('loginError', 'Email ou senha incorretos');
        }else{
            //updates the last login timestamp
            $user->last_login = date('Y-m-d H:i:s');
            $user->save;
        }

        //login user
        session([
            'user' =>[
                'id' =>$user->id,
                'username' => $user->username
            ]
        ]);

        return redirect()->to('/');



        //get users database
        //$userModel = new User();
        //$users = $userModel->all()->toArray();
        //echo '<pre>';
        //print_r($users);

    }

    public function logout(){
    //logout
    session()->forget('user');
    return redirect()->to('/login');
    }
}
