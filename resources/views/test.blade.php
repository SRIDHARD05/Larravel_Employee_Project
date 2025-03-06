@extends('layouts.app')

@section('content')
@if (Auth::check())
<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="btn btn-danger">Logout</button>
</form>

<h1>Welcome, {{ Auth::user()->name }} you are logged In..</h1>
{{ Auth::user()->name }}

@else

<a href="{{ route('login') }}" class="btn btn-primary btn-sm text-dark">Login</a>
<a href="{{ route('register') }}" class="btn btn-primary btn-sm text-dark">Register</a>

@endif



@endsection