<h1>{{ $horse->name }}</h1>

@if(session('success'))
    <p>{{ session('success') }}</p>
@endif

<p><strong>Stable:</strong> {{ $horse->stable->name }}</p>
<p><strong>Breed:</strong> {{ $horse->breed ?? '-' }}</p>
<p><strong>Age:</strong> {{ $horse->age ?? '-' }}</p>
<p><strong>Notes:</strong> {{ $horse->notes ?? '-' }}</p>

<p><a href="{{ route('horses.edit', $horse) }}">Edit</a></p>

<form method="POST" action="{{ route('horses.destroy', $horse) }}">
@csrf
@method('DELETE')
<button type="submit">Delete</button>
</form>

<p><a href="{{ route('horses.index') }}">Back</a></p>
