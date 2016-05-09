
@extends('layouts.app')
@section('content')
<h1>
    {{ $criterion->name }}
</h1>
Achievement: <a href="{{ route('achievement.show', ['id'=>$criterion->achievement->id]) }}">{{ $criterion->achievement->name }}</a>
@endsection
