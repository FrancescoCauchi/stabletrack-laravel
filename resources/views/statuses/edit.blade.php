@extends('layouts.app')

@section('content')
<h1 class="mb-3">Edit Status</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('statuses.update', $status) }}" class="card card-body">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Name</label>
        <input class="form-control" type="text" name="name" value="{{ old('name', $status->name) }}">
    </div>

    <div class="d-flex gap-2">
        <button class="btn btn-success" type="submit">Update</button>
        <a class="btn btn-secondary" href="{{ route('statuses.index') }}">Back</a>
    </div>
</form>
@endsection
