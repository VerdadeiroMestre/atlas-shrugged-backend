<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Realiza o login de um usuário
     * @api POST /login
     * 
     * @param \Illuminate\Http\Request $request contendo os seguintes dados necessários para o login:
     * @param string $email email do usuário
     * @param string $password senha do usuário
     * 
     * @return \Illuminate\Http\Response retorna um JSON contendo os dados do usuário
     */
    public function login(Request $request){
        $user = User::where('email', $request->email)->first();
        $user->makeVisible('password');
        if(!$user || !Hash::check($request->password,$user->password)){
            return response()->json([
                'message' => 'The provided credentials do not match our records.'
            ], 401);
        }
        return response($user,200);
    }

    /**
     * Registra um novo usuário
     * @api POST /register
     * 
     * @param \Illuminate\Http\Request $request contendo os seguintes dados necessários para o login:
     * @param string $name nome do usuário
     * @param string $email email do usuário
     * @param string $password senha do usuário
     * 
     * @return \Illuminate\Http\Response retorna um JSON contendo os dados do usuário
     */
    public function register(Request $request){
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();

        return response($user,200);
    }
}
