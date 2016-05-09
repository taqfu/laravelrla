    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form method="POST" action="{{ route('criteria.store') }}">
    {{ csrf_field() }}
    <input type='hidden' name='achievementID' value='{{ $achievement->id}}' />
    <input type='text' name='name' maxlength='255' />
    <input type='submit' value='Create Criteria' />
    <div>
    <input type='radio' name='proven' value="0" checked/> Unproven 
    <input type='radio' name='proven' value="1" /> Proven 
    </div>
</form>
