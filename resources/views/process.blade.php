@extends('layouts.app')

@section('content')

@foreach ($res as $result)
<ul>
    <li>{{ $result }}</li>
</ul>
    
@endforeach
@endsection