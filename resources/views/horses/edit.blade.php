<h1>Edit Horse</h1>

@if ($errors->any())
<ul>
@foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
@endforeach
</ul>
@endif

<form method="POST" action="{{ route('horses.update', $horse) }}">
@csrf
@method('PUT')

<label>Stable</label><br>
<select name="stable_id">
@foreach($stables as $stable)
    <option value="{{ $stable->id }}"
        @selected($horse->stable_id == $stable->id)>
        {{ $stable->name }}
    </option>
@endforeach
</select><br><br>

<label>Name</label><br>
<input type="text" name="name" value="{{ $horse->name }}"><br><br>

<label>Breed</label><br>
<input type="text" name="breed" value="{{ $horse->breed }}"><br><br>

<label>Age</label><br>
<input type="number" name="age" value="{{ $horse->age }}"><br><br>

<label>Notes</label><br>
<textarea name="notes">{{ $horse->notes }}</textarea><br><br>

<button type="submit">Update</button>
</form>

<p><a href="{{ route('horses.show', $horse) }}">Cancel</a></p>
