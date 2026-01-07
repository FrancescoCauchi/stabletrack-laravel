@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="mb-0">Horses</h1>
    <a href="{{ route('horses.create') }}" class="btn btn-primary">Add Horse</a>
</div>

<form method="GET" action="{{ route('horses.index') }}" class="card card-body mb-3">
    <div class="row g-3 align-items-end">
        <div class="col-md-5">
            <label class="form-label">Filter by Status</label>
            <select class="form-select" name="status">
                <option value="">All statuses</option>
                @foreach($statuses as $s)
                    <option value="{{ $s->id }}" @selected((string)$statusId === (string)$s->id)>
                        {{ $s->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-5">
            <label class="form-label">Sort</label>
            <select class="form-select" name="sort">
                <option value="name_asc" @selected($sort === 'name_asc')>Name (A → Z)</option>
                <option value="name_desc" @selected($sort === 'name_desc')>Name (Z → A)</option>
                <option value="stable_asc" @selected($sort === 'stable_asc')>Stable (A → Z)</option>
                <option value="stable_desc" @selected($sort === 'stable_desc')>Stable (Z → A)</option>
                <option value="status_asc" @selected($sort === 'status_asc')>Status (A → Z)</option>
                <option value="status_desc" @selected($sort === 'status_desc')>Status (Z → A)</option>
            </select>
        </div>

        <div class="col-md-2 d-flex gap-2">
            <button type="submit" class="btn btn-success w-100">Apply</button>
            <a href="{{ route('horses.index') }}" class="btn btn-secondary w-100">Reset</a>
        </div>
    </div>
</form>

@if(!empty($statusId))
    <div class="alert alert-info">
        Showing horses with selected status.
    </div>
@endif

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
    @forelse($horses as $horse)
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
    @empty
        <tr>
            <td colspan="4" class="text-center">No horses found.</td>
        </tr>
    @endforelse
    </tbody>
</table>
@endsection
