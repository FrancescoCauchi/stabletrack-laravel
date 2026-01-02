<h1>Add Horse</h1>

@if ($errors->any())
<ul>
@foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
@endforeach
</ul>
@endif

<form method="POST" action="{{ route('horses.store') }}">
@csrf

<label>Stable</label><br>
<select name="stable_id">
@foreach($stables as $stable)
    <option value="{{ $stable->id }}">{{ $stable->name }}</option>
@endforeach
</select><br><br>

<label>Name</label><br>
<input type="text" name="name"><br><br>

<label>Breed</label><br>
<input type="text" name="breed"><br><br>

<label>Age</label><br>
<input type="number" name="age"><br><br>

<label>Notes</label><br>
<textarea name="notes"></textarea><br><br>

<button type="submit">Save</button>
</form>

<p><a href="{{ route('horses.index') }}">Back</a></p>
