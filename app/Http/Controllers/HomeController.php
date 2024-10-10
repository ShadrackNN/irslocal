<?php

namespace App\Http\Controllers;

use App\Models\TaxInformation;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
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

            // Admin view doesn't need their own tax information, just client data
            return view('home', compact('clients'));
        }

        // If the user is a client, get their tax information
        $taxInfo = TaxInformation::where('user_id', auth()->id())->first();

        // Pass the client's tax information to the view
        return view('home', compact('taxInfo'));
    }
}
