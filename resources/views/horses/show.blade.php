@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="mb-0">{{ $horse->name }}</h1>

    <div class="d-flex gap-2">
        <a href="{{ route('horses.edit', $horse) }}" class="btn btn-warning">Edit</a>

        <form method="POST" action="{{ route('horses.destroy', $horse) }}"
              onsubmit="return confirm('Delete this horse?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <p><strong>Stable:</strong> {{ $horse->stable->name }}</p>
        <p><strong>Breed:</strong> {{ $horse->breed ?? '-' }}</p>
        <p><strong>Age:</strong> {{ $horse->age ?? '-' }}</p>
        <p class="mb-0"><strong>Notes:</strong> {{ $horse->notes ?? '-' }}</p>
    </div>
</div>

<a class="btn btn-secondary mt-3" href="{{ route('horses.index') }}">Back to list</a>
@endsection
