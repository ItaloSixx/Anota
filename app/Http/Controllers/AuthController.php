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
    public function loginSubmit(Request $request){
        //validation form
        $request->validate(
            //regras
            [
                'text_username' => 'required|email',
                'text_password' => 'required|min:8|max:22'
            ],
            //erros
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

        $user = User::where('username', $username)
                        ->where('deleted_at', NULL)
                        ->first();

        if(!$user){

        }

        //passoword check
        if(!password_verify($password, $user->password)){
            return redirect()
                    ->back()
                    ->withInput()
                    ->with('loginError', 'Email ou senha incorretos');
        }else{
            $user->last_login = date('Y-m-d H:i:s');
            $user->save;
            echo 'LOGIN COM SUCESSO';
        }

        //login user
        session([
            'user' =>[
                'id' =>$user->id,
                'username' => $user->username
            ]
        ]);

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
