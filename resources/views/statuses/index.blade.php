@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="mb-0">Statuses</h1>
    <a class="btn btn-primary" href="{{ route('statuses.create') }}">Add Status</a>
</div>

<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Name</th>
            <th>Horses</th>
            <th style="width: 260px;">Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach($statuses as $status)
        <tr>
            <td>{{ $status->name }}</td>
            <td>{{ $status->horses_count }}</td>
            <td class="d-flex gap-2">
                <a class="btn btn-sm btn-warning" href="{{ route('statuses.edit', $status) }}">Edit</a>

                <form method="POST" action="{{ route('statuses.destroy', $status) }}"
                      onsubmit="return confirm('Delete this status? Horses will keep working but their status will become empty.');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection
