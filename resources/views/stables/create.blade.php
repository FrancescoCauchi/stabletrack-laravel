@extends('layouts.app')

@section('content')
<h1 class="mb-3">Create Stable</h1>

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

    <div class="mb-3">
        <label class="form-label">Name</label>
        <input class="form-control" type="text" name="name" value="{{ old('name') }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Location</label>
        <input class="form-control" type="text" name="location" value="{{ old('location') }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea class="form-control" name="description" rows="4">{{ old('description') }}</textarea>
    </div>

    <div class="d-flex gap-2">
        <button class="btn btn-success" type="submit">Save</button>
        <a class="btn btn-secondary" href="{{ route('stables.index') }}">Back</a>
    </div>
</form>
@endsection
