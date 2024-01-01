@extends('dashboard.layout.master')

@section('title', 'Category')

@section('content')

    <div>
        <h2 class="text-center">All Products</h2>

        @if ($products->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Sl No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Category</th>
                        <th scope="col">Buy</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php $sl = 1; @endphp
                    @foreach ($products as $product)
                        <tr>
                            <th scope="row">{{ $sl }}</th>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td><a class="btn btn-primary" href="{{ route('purchase', $product->id) }}">purchase</a></td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a class="btn btn-primary" href="{{ route('product.edit', $product->id) }}">edit</a>
                                    <form action="{{ route('product.destroy', $product->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @php $sl++@endphp
                    @endforeach

                </tbody>
            </table>
        @else
            <h1 class="text-center">You have no Product.</h1>
        @endif
    </div>
    <div class="container">
        <h2 class="text-center">Import/Export Products</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="container mt-4">
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="file" class="form-label">Choose file to import:</label>
                            <input type="file" name="file" class="form-control" accept=".xls,.xlsx">
                        </div>
                        <button type="submit" class="btn btn-primary">Import</button>
                    </form>
                </div>

                <div class="col-md-6 d-flex align-items-center justify-content-center">
                    <a href="{{ route('export') }}" class="btn btn-success mt-md-0 mt-3">Export Products</a>
                </div>
            </div>
        </div>

    </div>
@endsection
