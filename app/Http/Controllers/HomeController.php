<?php

namespace App\Http\Controllers;

use App\FacebookUser;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $facebook_users = FacebookUser::paginate(15);

        return view('home', compact('facebook_users'));
    }
}
