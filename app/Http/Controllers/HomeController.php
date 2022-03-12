<?php

namespace App\Http\Controllers;

use App\Blog;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except("landingPage");
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $jml_admin = User::where("role", "admin")->count();
        $jml_artikel = Blog::count();
        return view('home', compact("jml_admin", "jml_artikel"));
    }

    public function landingPage()
    {
        return view("components.landing-page.master");
    }
}
