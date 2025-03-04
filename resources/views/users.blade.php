@extends('layouts.app')

@section('content')

@foreach ($users as $user)
<p>{{ $user->name }}'s roles:</p>
<ul>
    @foreach ($user->roles as $role)
    <li>{{ $role->name }}</li>
    @endforeach
</ul>
@endforeach



@endsection