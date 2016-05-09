@extends('layouts.app')

@section('content')
<h1 style='text-align:center;'>
    {{ $achievement->name }}
</h1>
@if (Auth::user())
    <?php $achievement_in_inventory=false; ?>
    @if ($achievement_owned->achievement_id == $achievement->id)
        <div class='inInventory'>
            In Inventory
        </div>
        <?php $achievement_in_inventory=true; ?>
    @endif
@include ('Criterion.create')
@endif
@foreach ($criteria as $criterion)
    <div> 
        @if (Auth::user() && $achievement_in_inventory)
            <?php $in_inventory=0; ?>
            @forelse ($owned_criteria as $owned_criterion)
                @if ($owned_criterion->criterion_id == $criterion->id)
                    <?php $in_inventory=$owned_criterion->id; ?>
                @endif
            @endforeach
            <div style='float:left;'>
            @if ($in_inventory != 0)
                &#10004;
            @else
                <form method='POST' action="{{ route('inventory.store') }}">
                    {{ csrf_field() }}
                    <input type='hidden' name='criterionID' value='{{$criterion->id}}' />
                    <input type='submit' value='[ Add ]' class='textButton' />
                </form>
            @endif
            </div>
        @endif
        <a href="{{ route('criteria.show', ['id'=> $criterion->id]) }}" >
            {{ $criterion->name }} 
        </a>
        @if (!$criterion->proven)
            <span class='unproven'>
                ( No proof required )
            </span>
        @endif
    </div>
@endforeach
@endsection
