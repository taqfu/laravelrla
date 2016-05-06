
@extends('layouts.app')

@section('content')
@if (Auth::user())
@include ('Achievement.create')
@endif
@foreach($achievements as $achievement)
    <div>
        <a href="{{ route('achievement.show', ['id'=>$achievement->id]) }}">{{ $achievement->name }}</a>
    </div>
@endforeach
@endsection
