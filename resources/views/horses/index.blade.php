@extends('layouts.app')

@section('content')
<h1 class="mb-3">Horses</h1>

<a href="{{ route('horses.create') }}" class="btn btn-primary mb-3">Add Horse</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Stable</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach($horses as $horse)
        <tr>
            <td>{{ $horse->name }}</td>
            <td>{{ $horse->stable->name }}</td>
            <td>
                <a href="{{ route('horses.show', $horse) }}" class="btn btn-sm btn-info">View</a>
                <a href="{{ route('horses.edit', $horse) }}" class="btn btn-sm btn-warning">Edit</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection
