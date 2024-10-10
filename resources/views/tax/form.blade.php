@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('tax.submit') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="income" class="form-label">Annual Income</label>
                <input type="number" class="form-control" id="income" name="income" required>
            </div>
            <!-- Add more form fields dynamically -->
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
