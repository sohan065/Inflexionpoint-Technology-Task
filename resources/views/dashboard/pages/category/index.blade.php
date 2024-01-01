@extends('dashboard.layout.master')

@section('title', 'Category')

@section('content')
    <div>
        <h2 class="text-center">All Categories</h2>

        @if ($categories->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Sl No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php $sl = 1; @endphp
                    @foreach ($categories as $category)
                        <tr>
                            <th scope="row">{{ $sl }}</th>
                            <td>{{ $category->name }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    {{-- <a class="btn btn-primary" href="{{ route('category.edit', $category->id) }}">edit</a> --}}
                                    <form action="{{ route('category.destroy', $category->id) }}" method="POST">
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
            <h1 class="text-center">You have no Category.</h1>
        @endif
    </div>

@endsection
