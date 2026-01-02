@extends('layouts.app')

@section('content')
<h1 class="mb-3">Edit Horse</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('horses.update', $horse) }}" class="card card-body">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Stable</label>
        <select class="form-select" name="stable_id">
            @foreach($stables as $stable)
                <option value="{{ $stable->id }}"
                    @selected(old('stable_id', $horse->stable_id) == $stable->id)>
                    {{ $stable->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Name</label>
        <input class="form-control" type="text" name="name" value="{{ old('name', $horse->name) }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Breed</label>
        <input class="form-control" type="text" name="breed" value="{{ old('breed', $horse->breed) }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Age</label>
        <input class="form-control" type="number" name="age" value="{{ old('age', $horse->age) }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Notes</label>
        <textarea class="form-control" name="notes" rows="4">{{ old('notes', $horse->notes) }}</textarea>
    </div>

    {{-- NEW: LeTROT URL --}}
    <div class="mb-3">
        <label class="form-label">LeTROT Profile URL (optional)</label>
        <input
            type="url"
            name="letrot_url"
            class="form-control @error('letrot_url') is-invalid @enderror"
            value="{{ old('letrot_url', $horse->letrot_url) }}"
            placeholder="https://www.letrot.com/..."
        >
        @error('letrot_url')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <div class="form-text">
            Paste the horse’s LeTROT profile link to confirm it has raced in France.
        </div>
    </div>

    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('horses.show', $horse) }}" class="btn btn-secondary">Cancel</a>
    </div>
</form>
@endsection
