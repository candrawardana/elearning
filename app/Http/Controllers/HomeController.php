<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Redirect;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(!Auth::user()){
            return view('welcome');
        }
        $MC = new MediaController();
        if(@$MC->akunjenis()=="admin" || @$MC->akunjenis()=="guru")
            return view('admin.dashboard');
        return view('home');
    }
    public function logout()
    {
        Auth::logout();
        return redirect('home');
    }
}
