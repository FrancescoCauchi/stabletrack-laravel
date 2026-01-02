<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>StableTrack</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="/">StableTrack</a>

        <div>
            <a class="btn btn-outline-light me-2" href="{{ route('stables.index') }}">Stables</a>
            <a class="btn btn-outline-light" href="{{ route('horses.index') }}">Horses</a>
        </div>
    </div>
</nav>

<div class="container">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @yield('content')
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
