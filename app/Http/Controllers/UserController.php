<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $user->makeVisible('password');
        if(!$user || !Hash::check($request->password,$user->password)){
            return response()->json(['message' => 'The provided credentials do not match our records.'], 401);
        }
        return $user;
    }
    public function register(Request $request)
    {
        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->save();

        return $user;
    }
}
