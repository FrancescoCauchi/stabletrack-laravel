@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="mb-0">{{ $stable->name }}</h1>
    <div class="d-flex gap-2">
        <a href="{{ route('stables.edit', $stable) }}" class="btn btn-warning">Edit</a>

        <form method="POST" action="{{ route('stables.destroy', $stable) }}"
              onsubmit="return confirm('Delete this stable?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <p><strong>Location:</strong> {{ $stable->location ?? '-' }}</p>
        <p class="mb-0"><strong>Description:</strong> {{ $stable->description ?? '-' }}</p>
    </div>
</div>

<a class="btn btn-secondary mt-3" href="{{ route('stables.index') }}">Back to list</a>
@endsection
