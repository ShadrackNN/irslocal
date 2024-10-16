<?php
namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\TaxInformation;
use Illuminate\Http\Response;

class TaxController extends Controller
{

    public function create(): Response
    {
        // Fetch existing tax information for the authenticated user
        $taxInfo = TaxInformation::where('user_id', auth()->id())->first();

        return response()->view('tax.form', compact('taxInfo'));
    }

    public function submit(Request $request): RedirectResponse
    {
        // Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'ssn' => 'required|string|max:11',
            'address' => 'required|string|max:255',
            'w2_income' => 'nullable|numeric',
            'self_employment_income' => 'nullable|numeric',
            'mortgage_interest' => 'nullable|numeric',
            'charitable_donations' => 'nullable|numeric',
            'child_tax_credit' => 'nullable|numeric',
            'education_credit' => 'nullable|numeric',
            'federal_tax_withheld' => 'nullable|numeric',
            'state_tax_withheld' => 'nullable|numeric',
        ]);

        // Save the tax information
        try {
            TaxInformation::updateOrCreate(
                ['user_id' => auth()->id()],
                [
                    'name' => $request->input('name'),
                    'ssn' => $request->input('ssn'),
                    'address' => $request->input('address'),
                    'w2_income' => $request->input('w2_income'),
                    'self_employment_income' => $request->input('self_employment_income'),
                    'mortgage_interest' => $request->input('mortgage_interest'),
                    'charitable_donations' => $request->input('charitable_donations'),
                    'child_tax_credit' => $request->input('child_tax_credit'),
                    'education_credit' => $request->input('education_credit'),
                    'federal_tax_withheld' => $request->input('federal_tax_withheld'),
                    'state_tax_withheld' => $request->input('state_tax_withheld'),
                ]
            );

            return redirect()->back()->with('status', 'Tax information saved successfully!');
        } catch (Exception $e) {
            return redirect()->back()->withErrors('Failed to save tax information: ' . $e->getMessage());
        }
    }
    public function downloadPdf(): Response
    {
        // Fetch the necessary data to be included in the PDF
        $data = TaxInformation::where('user_id', auth()->id())->firstOrFail();

        // Generate PDF
        $pdf = PDF::loadView('tax.pdf', compact('data'));

        // Download the PDF file
        return $pdf->download('tax_filing.pdf');
    }

}
