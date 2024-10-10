@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Client: {{ $client->name }}</h1>
        <p>Email: {{ $client->email }}</p>
        <p>Filing Status: {{ $client->filing_status }}</p>
        <p>Tax Status: {{ $client->tax_status }}</p>

        <!-- Add more details here as necessary, such as tax forms, income, deductions, etc. -->
        <a href="{{ route('client.index') }}" class="btn btn-secondary">Back to Clients</a>
    </div>
@endsection
