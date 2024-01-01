@extends('dashboard.layout.master')

@section('title', 'Post')

@section('content')

    <div class="container-lg">
        <div class="section-title text-center text-white">
            <h6>Create Category</h6>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Category Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

@endsection
