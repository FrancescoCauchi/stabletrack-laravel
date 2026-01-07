@extends('layouts.app')

@section('content')
<h1 class="mb-3">Add Stable</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('stables.store') }}" class="card card-body">
    @csrf

    {{-- Name --}}
    <div class="mb-3">
        <label class="form-label">Name</label>
        <input
            class="form-control"
            type="text"
            name="name"
            value="{{ old('name') }}"
            required
        >
    </div>

    {{-- Location --}}
    <div class="mb-3">
        <label class="form-label">Location</label>
        <input
            class="form-control"
            type="text"
            name="location"
            value="{{ old('location') }}"
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
        >{{ old('description') }}</textarea>
    </div>

    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('stables.index') }}" class="btn btn-secondary">Back</a>
    </div>
</form>
@endsection
