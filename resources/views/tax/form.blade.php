@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Tax Filing Form') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

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
                            </ul>

                            <div class="tab-content mt-3" id="taxFilingTabsContent">
                                {{-- Personal Information Tab --}}
                                <div class="tab-pane fade show active" id="personal" role="tabpanel" aria-labelledby="personal-tab">
                                    <h4>Personal Information</h4>
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Full Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter your full name" value="{{ old('name', $taxInfo->name ?? '') }}">
                                        @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="ssn" class="form-label">Social Security Number (SSN)</label>
                                        <input type="text" class="form-control @error('ssn') is-invalid @enderror" id="ssn" name="ssn" placeholder="Enter your SSN" value="{{ old('ssn', $taxInfo->ssn ?? '') }}">
                                        @error('ssn')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Address</label>
                                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" placeholder="Enter your address" value="{{ old('address', $taxInfo->address ?? '') }}">
                                        @error('address')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Income Tab --}}
                                <div class="tab-pane fade" id="income" role="tabpanel" aria-labelledby="income-tab">
                                    <h4>Income</h4>
                                    <div class="mb-3">
                                        <label for="w2-income" class="form-label">W-2 Income</label>
                                        <input type="number" class="form-control @error('w2_income') is-invalid @enderror" id="w2-income" name="w2_income" placeholder="Enter your W-2 income" value="{{ old('w2_income', $taxInfo->w2_income ?? '') }}">
                                        @error('w2_income')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="self-employment-income" class="form-label">Self-Employment Income (1099)</label>
                                        <input type="number" class="form-control @error('self_employment_income') is-invalid @enderror" id="self-employment-income" name="self_employment_income" placeholder="Enter your 1099 income" value="{{ old('self_employment_income', $taxInfo->self_employment_income ?? '') }}">
                                        @error('self_employment_income')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Deductions Tab --}}
                                <div class="tab-pane fade" id="deductions" role="tabpanel" aria-labelledby="deductions-tab">
                                    <h4>Deductions</h4>
                                    <div class="mb-3">
                                        <label for="mortgage-interest" class="form-label">Mortgage Interest</label>
                                        <input type="number" class="form-control @error('mortgage_interest') is-invalid @enderror" id="mortgage-interest" name="mortgage_interest" placeholder="Enter your mortgage interest" value="{{ old('mortgage_interest', $taxInfo->mortgage_interest ?? '') }}">
                                        @error('mortgage_interest')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="charitable-donations" class="form-label">Charitable Donations</label>
                                        <input type="number" class="form-control @error('charitable_donations') is-invalid @enderror" id="charitable-donations" name="charitable_donations" placeholder="Enter your charitable donations" value="{{ old('charitable_donations', $taxInfo->charitable_donations ?? '') }}">
                                        @error('charitable_donations')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Credits Tab --}}
                                <div class="tab-pane fade" id="credits" role="tabpanel" aria-labelledby="credits-tab">
                                    <h4>Credits</h4>
                                    <div class="mb-3">
                                        <label for="child-tax-credit" class="form-label">Child Tax Credit</label>
                                        <input type="number" class="form-control @error('child_tax_credit') is-invalid @enderror" id="child-tax-credit" name="child_tax_credit" placeholder="Enter your child tax credit" value="{{ old('child_tax_credit', $taxInfo->child_tax_credit ?? '') }}">
                                        @error('child_tax_credit')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="education-credit" class="form-label">Education Credit</label>
                                        <input type="number" class="form-control @error('education_credit') is-invalid @enderror" id="education-credit" name="education_credit" placeholder="Enter your education credit" value="{{ old('education_credit', $taxInfo->education_credit ?? '') }}">
                                        @error('education_credit')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Taxes Paid Tab --}}
                                <div class="tab-pane fade" id="taxes-paid" role="tabpanel" aria-labelledby="taxes-paid-tab">
                                    <h4>Taxes Paid</h4>
                                    <div class="mb-3">
                                        <label for="federal-tax-withheld" class="form-label">Federal Tax Withheld</label>
                                        <input type="number" class="form-control @error('federal_tax_withheld') is-invalid @enderror" id="federal-tax-withheld" name="federal_tax_withheld" placeholder="Enter your federal tax withheld" value="{{ old('federal_tax_withheld', $taxInfo->federal_tax_withheld ?? '') }}">
                                        @error('federal_tax_withheld')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="state-tax-withheld" class="form-label">State Tax Withheld</label>
                                        <input type="number" class="form-control @error('state_tax_withheld') is-invalid @enderror" id="state-tax-withheld" name="state_tax_withheld" placeholder="Enter your state tax withheld" value="{{ old('state_tax_withheld', $taxInfo->state_tax_withheld ?? '') }}">
                                        @error('state_tax_withheld')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{ route('tax.download_pdf') }}" class="btn btn-secondary">Download PDF</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
