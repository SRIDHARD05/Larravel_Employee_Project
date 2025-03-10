@extends('layouts.app')

@section('content')

<!-- @foreach ($notifications as $notification)
<div class="notification">
    <p>{{ $notification}}</p>
    <p>{{ $notification->data['action'] }}</p>
    <a href="{{ $notification->data['profile_url'] }}">View Profile</a>
    <p>Received at: {{ $notification->created_at->diffForHumans() }}</p>
</div>
@endforeach -->

{{ $unread }}


{{ $unread }}
@endsection