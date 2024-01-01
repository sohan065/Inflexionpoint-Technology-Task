@extends('dashboard.layout.master')

@section('title', 'Dashboard')


@section('content')

    <div class="container mt-3">
        <h1>Welcome to Your Dashboard</h1>

        @if (session('error'))
            <div class="alert alert-danger mt-3">
                {{ session('error') }}
            </div>
        @endif

    </div>


@endsection
