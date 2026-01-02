@extends('layouts.app')

@section('content')
<h1 class="mb-3">Add Horse</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('horses.store') }}" class="card card-body">
    @csrf

    <div class="mb-3">
        <label class="form-label">Stable</label>
        <select class="form-select" name="stable_id">
            @foreach($stables as $stable)
                <option value="{{ $stable->id }}" @selected(old('stable_id') == $stable->id)>
                    {{ $stable->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Name</label>
        <input class="form-control" type="text" name="name" value="{{ old('name') }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Breed</label>
        <input class="form-control" type="text" name="breed" value="{{ old('breed') }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Age</label>
        <input class="form-control" type="number" name="age" value="{{ old('age') }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Notes</label>
        <textarea class="form-control" name="notes" rows="4">{{ old('notes') }}</textarea>
    </div>

    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('horses.index') }}" class="btn btn-secondary">Back</a>
    </div>
</form>
@endsection
