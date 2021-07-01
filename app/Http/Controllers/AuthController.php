<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Hash};

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware("guest")->except("logout");
    }
    public function index()
    {
        $title = "Login";
        return view("auth.login", compact("title"));
    }


    public function login(Request $request)
    {
        $account = User::where("email", $request->email)?->first();
        if($account)
        {
            if(Hash::check($request->password, $account->password))
            {
                Auth::login($account);
                return redirect()->to(route("index"));
            }
        }
        else
        {
            session()->flash("failed", "Email atau password anda salah!");
            return redirect()->to(route("login"));
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route("login");
    }
}
