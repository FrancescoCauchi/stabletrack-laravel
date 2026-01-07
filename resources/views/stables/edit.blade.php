@extends('layouts.app')

@section('content')
<h1 class="mb-3">Edit Stable</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('stables.update', $stable) }}" class="card card-body">
    @csrf
    @method('PUT')

    {{-- Name --}}
    <div class="mb-3">
        <label class="form-label">Name</label>
        <input
            class="form-control"
            type="text"
            name="name"
            value="{{ old('name', $stable->name) }}"
            required
        >
    </div>

    {{-- Location (REQUIRED) --}}
    <div class="mb-3">
        <label class="form-label">Location</label>
        <input
            class="form-control"
            type="text"
            name="location"
            value="{{ old('location', $stable->location) }}"
            required
        >
    </div>

    {{-- Description --}}
    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea
            class="form-control"
            name="description"
            rows="3"
        >{{ old('description', $stable->description) }}</textarea>
    </div>

    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('stables.show', $stable) }}" class="btn btn-secondary">Cancel</a>
    </div>
</form>
@endsection
