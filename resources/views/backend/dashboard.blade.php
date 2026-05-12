@extends('frontend.components.layout')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h1>Admin Dashboard</h1>
            <p>Welcome, admin.</p>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button class="btn btn-danger">Logout</button>
            </form>
        </div>
    </div>
</div>
@endsection
