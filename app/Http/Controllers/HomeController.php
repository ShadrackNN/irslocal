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

        // Calculate the tax if taxInfo is available
        $taxableIncome = ($taxInfo->w2_income ?? 0) + ($taxInfo->self_employment_income ?? 0)
            - (($taxInfo->mortgage_interest ?? 0) + ($taxInfo->charitable_donations ?? 0));

        $estimatedTax = $this->calculateTax($taxableIncome);

        // Pass the client's tax information and estimated tax to the view
        return view('home', compact('taxInfo', 'estimatedTax'));
    }

    /**
     * Calculate tax based on taxable income.
     *
     * @param float $taxableIncome
     * @return float
     */
    protected function calculateTax(float $taxableIncome): float
    {
        $tax = 0;
        if ($taxableIncome <= 11000) {
            $tax = $taxableIncome * 0.10;
        } elseif ($taxableIncome <= 44725) {
            $tax = 1100 + ($taxableIncome - 11000) * 0.12;
        } elseif ($taxableIncome <= 95375) {
            $tax = 5147 + ($taxableIncome - 44725) * 0.22;
        } elseif ($taxableIncome <= 182100) {
            $tax = 16290 + ($taxableIncome - 95375) * 0.24;
        } elseif ($taxableIncome <= 231250) {
            $tax = 37104 + ($taxableIncome - 182100) * 0.32;
        } elseif ($taxableIncome <= 578125) {
            $tax = 52832 + ($taxableIncome - 231250) * 0.35;
        } else {
            $tax = 174238.75 + ($taxableIncome - 578125) * 0.37;
        }
        return $tax;
    }
}
