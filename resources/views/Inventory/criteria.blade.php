@foreach ($criteria_in_inventory as $criterion_in_inventory)
        <input id='hideList{{$achievement_in_inventory->id}}' type='button' class='hideList textButton' value='[-]'/>
    <div class='criterionInInventory'>
        @if ($criterion_in_inventory->criterion->achievement_id==$achievement_in_inventory->achievement_id)
        @if ($criterion_in_inventory->active)
            <div class='active' style='float:left;'>
        @else
            <div style='float:left;'>
        @endif
        <form method="POST" action="{{route('inventory.destroy', ['id'=>$criterion_in_inventory->id])}}" style='float:left;margin-right:8px;'>
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <input type='submit' value='x' class='textButton delete' />
        </form>
        {{ $criterion_in_inventory->criterion->name }}
        <a href="{{route('criteria.show', ['id'=>$criterion_in_inventory->criterion_id])}}">(Profile)</a>
        </div>
        @endif
                <form method='POST' action="{{ route('inventory.update', ['id'=>$criterion_in_inventory->id]) }}" 
                  style='float:left;'>
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                @if ($criterion_in_inventory->active)
                    <input type='hidden' name='active' value="0" />
                    <input type='submit' value='[ Active ]' class='textButton'/>
                @else
                    <input type='hidden' name='active' value="1" />
                    <input type='submit' value='[ Inactive ]' class='textButton'/>
                @endif
                </form>
        
                <form method="POST" action="{{ route('inventory.update', ['id'=>$criterion_in_inventory->id]) }}" 
                  style='float:left;'>
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    @if ($criterion_in_inventory->visible)
                        <input type='hidden' name='visible' value="0" />
                        <input type='submit' value='[ Visible To Public ]' class='textButton'/>
                    @else
                        <input type='hidden' name='visible' value="1" />
                        <input type='submit' value='[ Private ]' class='textButton'/>
                    @endif
    
                </form>
    </div>
@endforeach
