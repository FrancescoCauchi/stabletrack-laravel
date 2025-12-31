<h1>Stables</h1>

<p><a href="{{ route('stables.create') }}">Create new stable</a></p>

@if(session('success'))
  <p>{{ session('success') }}</p>
@endif

<ul>
@foreach($stables as $stable)
  <li>
    <a href="{{ route('stables.show', $stable) }}">{{ $stable->name }}</a>
  </li>
@endforeach
</ul>
