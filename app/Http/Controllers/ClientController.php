<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the clients.
     *
     * @return View|Factory
     */
    public function index(): View|Factory
    {
        // Retrieve all clients (assuming 'client' is their role)
        $clients = User::where('role', 'client')->get();

        // Return a view to list clients (create this view if it doesn't exist)
        return view('clients.index', compact('clients'));
    }

    /**
     * Show the details for a specific client.
     *
     * @param int $id
     * @return View|Factory
     */
    public function show($id): View|Factory
    {
        // Retrieve the client by ID
        $client = User::findOrFail($id);

        // Return a view to display the client's tax details (create this view if needed)
        return view('clients.show', compact('client'));
    }
}
