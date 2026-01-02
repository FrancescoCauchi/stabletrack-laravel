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

    <div class="mb-3">
        <label class="form-label">Name</label>
        <input class="form-control" type="text" name="name" value="{{ old('name', $stable->name) }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Location</label>
        <input class="form-control" type="text" name="location" value="{{ old('location', $stable->location) }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea class="form-control" name="description" rows="4">{{ old('description', $stable->description) }}</textarea>
    </div>

    <div class="d-flex gap-2">
        <button class="btn btn-success" type="submit">Update</button>
        <a class="btn btn-secondary" href="{{ route('stables.show', $stable) }}">Cancel</a>
    </div>
</form>
@endsection
