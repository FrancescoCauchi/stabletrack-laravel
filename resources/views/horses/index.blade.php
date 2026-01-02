<h1>Horses</h1>

<p><a href="{{ route('horses.create') }}">Add Horse</a></p>

@if(session('success'))
    <p>{{ session('success') }}</p>
@endif

<ul>
@foreach($horses as $horse)
    <li>
        <a href="{{ route('horses.show', $horse) }}">
            {{ $horse->name }}
        </a>
        ({{ $horse->stable->name }})
    </li>
@endforeach
</ul>
