<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function Login()
    {
        return view("auth.login");
    }

    public function AttemptLogin(Request $request)
    {
        if($user = User::where("email", $request->email)->where("password", bcrypt($request->password))->first()) {
            auth()->attempt($user->toArray());
        }

        dd(auth()->user());
    }
}
