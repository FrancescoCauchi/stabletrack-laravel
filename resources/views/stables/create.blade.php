<h1>Create Stable</h1>

@if ($errors->any())
  <ul>
    @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
    @endforeach
  </ul>
@endif

<form method="POST" action="{{ route('stables.store') }}">
  @csrf

  <label>Name</label><br>
  <input type="text" name="name" value="{{ old('name') }}"><br><br>

  <label>Location</label><br>
  <input type="text" name="location" value="{{ old('location') }}"><br><br>

  <label>Description</label><br>
  <textarea name="description">{{ old('description') }}</textarea><br><br>

  <button type="submit">Save</button>
</form>

<p><a href="{{ route('stables.index') }}">Back</a></p>
