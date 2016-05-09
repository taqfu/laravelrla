
@extends('layouts.app')

@section('content')
<h1>
Achievements
</h1>
@if (Auth::user())
<!--@include ('Achievement.create')-->
@endif
<div style='clear:both;'>
@foreach($achievements as $achievement)
    @if (Auth::user())
        <?php $in_inventory=false; ?>
        @forelse ($inventory as $inventory_item)
            @if ($inventory_item->achievement_id == $achievement->id)
                <?php $in_inventory=true; ?>
            @endif
        @endforeach
        <div style='float:left;'>
        @if ($in_inventory)
            &#10004;
        @else
            <form method='POST' action="{{ route('inventory.store') }}">
                {{ csrf_field() }}
                <input type='hidden' name='achievementID' value='{{$achievement->id}}' />
                <input type='submit' value='[ Add ]' class='textButton' />
            </form>
        @endif
        </div>
    @endif
    
    <div style='position:relative;float:left;margin-left:16px;'>
    <a href="{{ route('achievement.show', ['id'=>$achievement->id]) }}">
        <span class='clickableDiv'></span>
        {{ $achievement->name }}
    </a>
    </div>
@endforeach
</div>
@endsection
