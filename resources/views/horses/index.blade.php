@extends('layouts.app')

@section('content')
<h1 class="mb-3">Horses</h1>

<a href="{{ route('horses.create') }}" class="btn btn-primary mb-3">Add Horse</a>

<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Name</th>
            <th>Stable</th>
            <th>Status</th>
            <th style="width: 280px;">Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach($horses as $horse)
        <tr>
            <td>{{ $horse->name }}</td>
            <td>{{ $horse->stable->name }}</td>
            <td>
                @if($horse->status)
                    <span class="badge bg-secondary">{{ $horse->status->name }}</span>
                @else
                    -
                @endif
            </td>
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
@endsection
