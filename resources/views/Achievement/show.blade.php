
@extends('layouts.app')

@section('content')
<h1>
    {{ $achievement->name }}
</h1>

@include ('Criterion.create')
@endsection
