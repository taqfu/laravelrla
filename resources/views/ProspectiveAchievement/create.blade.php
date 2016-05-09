@if (count($errors) > 0)
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form id='newAchievement' method="POST" action="{{route('achievement.store')}}">
    {{ csrf_field() }}
    <input type='text' name='name' maxlength='255'/>
    <input type='submit' value='Create' />
</form>
