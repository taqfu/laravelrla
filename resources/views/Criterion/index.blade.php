
@extends('layouts.app')

@section('content')
@if (Auth::user())
@include ('Criterion.create')
@endif
@foreach ($criteria as $criterion)
    {{ $criterion->name }}
@endforeach
@endsection
