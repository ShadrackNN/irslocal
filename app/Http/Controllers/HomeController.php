<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
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
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        if (auth()->user()->role === 'admin') {
            // If the user is an admin, get all clients
            $clients = User::where('role', 'client')->get();
            return view('home', compact('clients'));
        }

        // If the user is a client, just return the home view with their tax tabs
        return view('home');
    }

}
