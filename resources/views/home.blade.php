@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{-- Dynamic content based on role --}}
                        @if (auth()->user()->role === 'client')
                            <h3>{{ __('Tax Filing Progress') }}</h3>

                            {{-- Form to handle the tax information --}}
                            <form method="POST" action="{{ route('tax.submit') }}">
                                @csrf

                                {{-- Tabs for client to fill in tax information --}}
                                <ul class="nav nav-tabs" id="taxFilingTabs" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="personal-tab" data-bs-toggle="tab" href="#personal" role="tab" aria-controls="personal" aria-selected="true">Personal Information</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="income-tab" data-bs-toggle="tab" href="#income" role="tab" aria-controls="income" aria-selected="false">Income</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="deductions-tab" data-bs-toggle="tab" href="#deductions" role="tab" aria-controls="deductions" aria-selected="false">Deductions</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="credits-tab" data-bs-toggle="tab" href="#credits" role="tab" aria-controls="credits" aria-selected="false">Credits</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="taxes-paid-tab" data-bs-toggle="tab" href="#taxes-paid" role="tab" aria-controls="taxes-paid" aria-selected="false">Taxes Paid</a>
                                    </li>
                                    {{-- New Tax Calculation Tab --}}
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="calculation-tab" data-bs-toggle="tab" href="#calculation" role="tab" aria-controls="calculation" aria-selected="false">Tax Calculation</a>
                                    </li>
                                </ul>


                                <div class="tab-content mt-3" id="taxFilingTabsContent">
                                    {{-- Personal Information Tab --}}
                                    <div class="tab-pane fade show active" id="personal" role="tabpanel" aria-labelledby="personal-tab">
                                        <h4>Personal Information</h4>
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Full Name</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter your full name" value="{{ old('name', $taxInfo->name ?? '') }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="ssn" class="form-label">Social Security Number (SSN)</label>
                                            <input type="text" class="form-control" id="ssn" name="ssn" placeholder="Enter your SSN" value="{{ old('ssn', $taxInfo->ssn ?? '') }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Address</label>
                                            <input type="text" class="form-control" id="address" name="address" placeholder="Enter your address" value="{{ old('address', $taxInfo->address ?? '') }}">
                                        </div>
                                    </div>

                                    {{-- Income Tab --}}
                                    <div class="tab-pane fade" id="income" role="tabpanel" aria-labelledby="income-tab">
                                        <h4>Income</h4>
                                        <div class="mb-3">
                                            <label for="w2-income" class="form-label">W-2 Income</label>
                                            <input type="number" class="form-control" id="w2-income" name="w2_income" placeholder="Enter your W-2 income" value="{{ old('w2_income', $taxInfo->w2_income ?? '') }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="self-employment-income" class="form-label">Self-Employment Income (1099)</label>
                                            <input type="number" class="form-control" id="self-employment-income" name="self_employment_income" placeholder="Enter your 1099 income" value="{{ old('self_employment_income', $taxInfo->self_employment_income ?? '') }}">
                                        </div>
                                    </div>

                                    {{-- Deductions Tab --}}
                                    <div class="tab-pane fade" id="deductions" role="tabpanel" aria-labelledby="deductions-tab">
                                        <h4>Deductions</h4>
                                        <div class="mb-3">
                                            <label for="mortgage-interest" class="form-label">Mortgage Interest</label>
                                            <input type="number" class="form-control" id="mortgage-interest" name="mortgage_interest" placeholder="Enter your mortgage interest" value="{{ old('mortgage_interest', $taxInfo->mortgage_interest ?? '') }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="charitable-donations" class="form-label">Charitable Donations</label>
                                            <input type="number" class="form-control" id="charitable-donations" name="charitable_donations" placeholder="Enter the amount of charitable donations" value="{{ old('charitable_donations', $taxInfo->charitable_donations ?? '') }}">
                                        </div>
                                    </div>

                                    {{-- Credits Tab --}}
                                    <div class="tab-pane fade" id="credits" role="tabpanel" aria-labelledby="credits-tab">
                                        <h4>Credits</h4>
                                        <div class="mb-3">
                                            <label for="child-tax-credit" class="form-label">Child Tax Credit</label>
                                            <input type="number" class="form-control" id="child-tax-credit" name="child_tax_credit" placeholder="Enter the amount for Child Tax Credit" value="{{ old('child_tax_credit', $taxInfo->child_tax_credit ?? '') }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="education-credit" class="form-label">Education Credit</label>
                                            <input type="number" class="form-control" id="education-credit" name="education_credit" placeholder="Enter the amount for Education Credit" value="{{ old('education_credit', $taxInfo->education_credit ?? '') }}">
                                        </div>
                                    </div>

                                    {{-- Taxes Paid Tab --}}
                                    <div class="tab-pane fade" id="taxes-paid" role="tabpanel" aria-labelledby="taxes-paid-tab">
                                        <h4>Taxes Paid</h4>
                                        <div class="mb-3">
                                            <label for="federal-tax-withheld" class="form-label">Federal Tax Withheld</label>
                                            <input type="number" class="form-control" id="federal-tax-withheld" name="federal_tax_withheld" placeholder="Enter the amount of federal tax withheld" value="{{ old('federal_tax_withheld', $taxInfo->federal_tax_withheld ?? '') }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="state-tax-withheld" class="form-label">State Tax Withheld</label>
                                            <input type="number" class="form-control" id="state-tax-withheld" name="state_tax_withheld" placeholder="Enter the amount of state tax withheld" value="{{ old('state_tax_withheld', $taxInfo->state_tax_withheld ?? '') }}">
                                        </div>

                                        {{-- Download PDF Button (only on the last tab) --}}
                                        <div class="text-center my-4">
                                            <a href="{{ route('tax.download_pdf') }}" class="btn btn-primary">Download PDF</a>
                                        </div>
                                    </div>

                                    {{-- Tax Calculation Tab --}}
                                    <div class="tab-pane fade" id="calculation" role="tabpanel" aria-labelledby="calculation-tab">
                                        <h4>Tax Calculation</h4>
                                        <div class="mb-3">
                                            <label for="total-income" class="form-label">Total Income</label>
                                            <input type="number" class="form-control" id="total-income" name="total_income" value="{{ ($taxInfo->w2_income ?? 0) + ($taxInfo->self_employment_income ?? 0) }}" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="total-deductions" class="form-label">Total Deductions</label>
                                            <input type="number" class="form-control" id="total-deductions" name="total_deductions" value="{{ ($taxInfo->mortgage_interest ?? 0) + ($taxInfo->charitable_donations ?? 0) }}" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="taxable-income" class="form-label">Taxable Income</label>
                                            <input type="number" class="form-control" id="taxable-income" name="taxable_income" value="{{ (($taxInfo->w2_income ?? 0) + ($taxInfo->self_employment_income ?? 0)) - (($taxInfo->mortgage_interest ?? 0) + ($taxInfo->charitable_donations ?? 0)) }}" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="estimated-tax" class="form-label">Estimated Tax</label>
                                            <input type="number" class="form-control" id="estimated-tax" name="estimated_tax" value="{{ $estimatedTax }}" readonly>
                                        </div>
                                    </div>

                                </div>

                                {{-- Save Changes Button --}}
                                <div class="text-center my-4">
                                    <button type="submit" class="btn btn-success">Save Changes</button>
                                </div>

                                {{-- Next and Previous Buttons --}}
                                <div class="d-flex justify-content-between">
                                    <button type="button" class="btn btn-secondary" onclick="prevTab()">Previous</button>
                                    <button type="button" class="btn btn-primary" onclick="nextTab()">Next</button>
                                </div>
                            </form>
                        @elseif (auth()->user()->role === 'admin')
                            <h3>{{ __('Clients Overview') }}</h3>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Client Name</th>
                                    <th>Email</th>
                                    <th>Tax Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($clients as $client)
                                    <tr>
                                        <td>{{ $client->name }}</td>
                                        <td>{{ $client->email }}</td>
                                        <td>{{ $client->tax_status }}</td>
                                        <td>
                                            <a href="{{ route('home', $client->id) }}" class="btn btn-info">View</a>
                                            <a href="{{ route('home', $client->id) }}" class="btn btn-warning">Edit</a>
                                            <a href="{{ route('home', $client->id) }}" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Script for tab navigation --}}
    <script>
        function nextTab() {
            var activeTab = document.querySelector('.nav-link.active');
            var nextTab = activeTab.closest('li').nextElementSibling;
            if (nextTab) {
                nextTab.querySelector('.nav-link').click();
            }
        }

        function prevTab() {
            var activeTab = document.querySelector('.nav-link.active');
            var prevTab = activeTab.closest('li').previousElementSibling;
            if (prevTab) {
                prevTab.querySelector('.nav-link').click();
            }
        }

        // Basic tax calculation based on 2023 tax brackets for single filers
        function calculateTax(taxableIncome) {
            let tax = 0;
            if (taxableIncome <= 11000) {
                tax = taxableIncome * 0.10;
            } else if (taxableIncome <= 44725) {
                tax = 1100 + (taxableIncome - 11000) * 0.12;
            } else if (taxableIncome <= 95375) {
                tax = 5147 + (taxableIncome - 44725) * 0.22;
            } else if (taxableIncome <= 182100) {
                tax = 16290 + (taxableIncome - 95375) * 0.24;
            } else if (taxableIncome <= 231250) {
                tax = 37104 + (taxableIncome - 182100) * 0.32;
            } else if (taxableIncome <= 578125) {
                tax = 52832 + (taxableIncome - 231250) * 0.35;
            } else {
                tax = 174238.75 + (taxableIncome - 578125) * 0.37;
            }
            return tax;
        }
    </script>

@endsection
