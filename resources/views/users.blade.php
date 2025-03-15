@extends('layouts.app')

@section('content')

@foreach ($users as $user)
<ul>
    <br>
    <li>{{ $user->email_verified_at }}</li>
    <li>{{ $user }}</li>
</ul>
@endforeach



@endsection