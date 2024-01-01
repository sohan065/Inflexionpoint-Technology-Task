<div class="header">
    <div class="section-title">
        <div class="navbar-left">
            <ul class="d-flex align-items-center">
                <li><a class="btn btn-primary" href="{{ route('category.create') }}">Create Category</a></li>
                <li><a class="btn btn-primary" href="{{ route('product.create') }}">Store Product</a></li>

            </ul>
        </div>
    </div>
    <div class="user-info ">

        <div class="user-img text-center">
            <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" />
            @auth
                <p> {{ auth()->user()->name }}</p>
            @endauth

        </div>
    </div>
</div>
@section('script')
    <script>
        $(function() {
            $("#datepicker-start").datepicker();
            $("#datepicker-end").datepicker();
        });
    </script>
@endsection
