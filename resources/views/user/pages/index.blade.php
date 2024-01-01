@extends('user.layout.master')

@section('title', 'Home Page')


@section('content')

    <div class="container bg-light mt-3 text-center">
        <h1>Home Page</h1>
    </div>
    {{-- <div class="container bg-light mt-3">
        <div class="text-center">
            <h3>All Products</h3>
        </div>
        <div class="row">

            @forelse ($products as $product)
                <div class="col-lg-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Product Name: {{ $product->name }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Category: {{ $product->category->name }}</h6>
                            <p class="card-text">Price: ${{ $product->price }}</p>
                            <p class="card-text">Quantity: {{ $product->quantity }}</p>
                        </div>
                    </div>
                </div>

            @empty

                <div class="col-md-12">
                    <p>No product found.</p>
                </div>
            @endforelse

        </div>
    </div> --}}

@endsection
