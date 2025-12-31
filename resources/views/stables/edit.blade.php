<h1>Edit Stable</h1>

@if ($errors->any())
  <ul>
    @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
    @endforeach
  </ul>
@endif

<form method="POST" action="{{ route('stables.update', $stable) }}">
  @csrf
  @method('PUT')

  <label>Name</label><br>
  <input type="text" name="name" value="{{ old('name', $stable->name) }}"><br><br>

  <label>Location</label><br>
  <input type="text" name="location" value="{{ old('location', $stable->location) }}"><br><br>

  <label>Description</label><br>
  <textarea name="description">{{ old('description', $stable->description) }}</textarea><br><br>

  <button type="submit">Update</button>
</form>

<p><a href="{{ route('stables.show', $stable) }}">Cancel</a></p>
