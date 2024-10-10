@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Clients</h1>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Client Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($clients as $client)
                <tr>
                    <td>{{ $client->name }}</td>
                    <td>{{ $client->email }}</td>
                    <td>
                        <a href="{{ route('client.show', $client->id) }}" class="btn btn-info">View Details</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
