
<?php use \App\Inventory; ?>
@extends('layouts.app')
@section('content')
<h1>
    {{ Auth::user()->name }}'s inventory
</h1>
    @forelse ($achievements_in_inventory as $achievement_in_inventory)
        <div>
            <div style='float:left;'>
            @if ($achievement_in_inventory->active)
                <span class='achievementInInventory active'>
            @else 
                <span class='achievementInInventory'>
            @endif
            <form method="POST" action="{{route('inventory.destroy', ['id'=>$achievement_in_inventory->id])}}" style='float:left;margin-right:8px;'>
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <input type='submit' value='x' class='textButton delete' />
            </form>
                {{ $achievement_in_inventory->achievement->name }} 
            </span>
            <a href="{{ route('achievement.show', ['id'=>$achievement_in_inventory->achievement_id]) }}" style='margin-left:8px;'>
                (Profile)
            </a>
            </div>
                <form method='POST' action="{{ route('inventory.update', ['id'=>$achievement_in_inventory->id]) }}" 
                  style='float:left;margin-left:8px;'>
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                @if ($achievement_in_inventory->active)
                    <input type='hidden' name='active' value="0" />
                    <input type='submit' value='Active' class='textButton'/>
                @else
                    <input type='hidden' name='active' value="1" />
                    <input type='submit' value='Inactive' class='textButton'/>
                @endif
                </form>
        
                <form method="POST" action="{{ route('inventory.update', ['id'=>$achievement_in_inventory->id]) }}" 
                  style='float:left;margin-left:8px;'>
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    @if ($achievement_in_inventory->visible)
                        <input type='hidden' name='visible' value="0" />
                        <input type='submit' value='Visible To Public' class='textButton'/>
                    @else
                        <input type='hidden' name='visible' value="1" />
                        <input type='submit' value='Private' class='textButton'/>
                    @endif
    
                </form>
            <?php $achievement_has_criteria=false; ?>
            @foreach ($criteria_in_inventory as $criterion_in_inventory)
                @if ($criterion_in_inventory->criterion->achievement_id==$achievement_in_inventory->achievement_id)
                    <?php $achievement_has_criteria=true; ?>
                @endif
            @endforeach
            
        </div>
        
            @if ($achievement_has_criteria)
                @if (!$achievement_in_inventory->active)
            <div id='listOfAchievementCriteria{{ $achievement_in_inventory->id }}' 
              class='listOfAchievementCriteria inactiveList'>
                @else 
            <div id='listOfAchievementCriteria{{ $achievement_in_inventory->id }}' class='listOfAchievementCriteria'>
                @endif
            @include ('Inventory.criteria')
            </div>
                @if (!$achievement_in_inventory->active)
                <div id='showListDiv{{$achievement_in_inventory->id}}' style='clear:both;'>
                    <input id='showList{{$achievement_in_inventory->id}}' type='button' class='showList textButton' value='[ + ]'/>      
                </div>
                @endif
            @endif
    @empty
        You do not have any achievements in your inventory.        
    @endforelse
@endsection
