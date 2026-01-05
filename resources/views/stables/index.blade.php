@extends('layouts.app')

@section('content')
<h1 class="mb-3">Stables</h1>

<a href="{{ route('stables.create') }}" class="btn btn-primary mb-3">Create new stable</a>

<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Name</th>
            <th>Location</th>
            <th style="width: 280px;">Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach($stables as $stable)
        <tr>
            <td>{{ $stable->name }}</td>
            <td>{{ $stable->location ?? '-' }}</td>
            <td class="d-flex gap-2">
                <a href="{{ route('stables.show', $stable) }}" class="btn btn-sm btn-info">View</a>
                <a href="{{ route('stables.edit', $stable) }}" class="btn btn-sm btn-warning">Edit</a>

                <form method="POST" action="{{ route('stables.destroy', $stable) }}"
                      onsubmit="return confirm('Delete this stable?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection
