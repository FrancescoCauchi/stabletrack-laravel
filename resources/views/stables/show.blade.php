@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="mb-0">{{ $stable->name }}</h1>

    <div class="d-flex gap-2">
        <a href="{{ route('stables.edit', $stable) }}" class="btn btn-warning">Edit</a>

        <form method="POST" action="{{ route('stables.destroy', $stable) }}"
              onsubmit="return confirm('Delete this stable? This will also delete its horses.');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
</div>

<div class="card mb-4">
    <div class="card-body">
        <p><strong>Location:</strong> {{ $stable->location ?? '-' }}</p>
        <p class="mb-0"><strong>Description:</strong> {{ $stable->description ?? '-' }}</p>
    </div>
</div>

<div class="d-flex justify-content-between align-items-center mb-2">
    <h2 class="h4 mb-0">Horses in this stable</h2>
    <a class="btn btn-primary btn-sm" href="{{ route('horses.create') }}">Add Horse</a>
</div>

@if($stable->horses->isEmpty())
    <div class="alert alert-secondary">
        No horses added yet.
    </div>
@else
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Name</th>
                <th>Breed</th>
                <th>Age</th>
                <th style="width: 280px;">Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($stable->horses as $horse)
            <tr>
                <td>{{ $horse->name }}</td>
                <td>{{ $horse->breed ?? '-' }}</td>
                <td>{{ $horse->age ?? '-' }}</td>
                <td class="d-flex gap-2">
                    <a href="{{ route('horses.show', $horse) }}" class="btn btn-sm btn-info">View</a>
                    <a href="{{ route('horses.edit', $horse) }}" class="btn btn-sm btn-warning">Edit</a>

                    <form method="POST" action="{{ route('horses.destroy', $horse) }}"
                          onsubmit="return confirm('Delete this horse?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif

<a class="btn btn-secondary mt-3" href="{{ route('stables.index') }}">Back to list</a>
@endsection
