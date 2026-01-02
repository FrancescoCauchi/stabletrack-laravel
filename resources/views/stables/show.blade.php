<h1>{{ $stable->name }}</h1>

@if(session('success'))
  <p>{{ session('success') }}</p>
@endif

<p><strong>Location:</strong> {{ $stable->location ?? '-' }}</p>
<p><strong>Description:</strong> {{ $stable->description ?? '-' }}</p>

<p>
  <a href="{{ route('stables.edit', $stable) }}">Edit</a>
</p>

<form method="POST" action="{{ route('stables.destroy', $stable) }}">
  @csrf
  @method('DELETE')
  <button type="submit">Delete</button>
</form>

<p><a href="{{ route('stables.index') }}">Back to list</a></p>
