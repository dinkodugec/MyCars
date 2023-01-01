<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Car;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $cars = Car::select()
        ->where('user_id', auth()->id()) //where user id is my ID/auth
        ->orderBy('updated_at', "DESC")
        ->get();

        return view('home')->with([
            'cars'=> $cars      //passing cars variable
        ]);
    }
}