<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard with clients overview.
     */
    public function index(): View|Factory|Application
    {
        // Fetch all clients
        $clients = User::where('role', 'client')->get();

        // Return the view with clients data
        return view('admin.dashboard', compact('clients'));
    }
}
