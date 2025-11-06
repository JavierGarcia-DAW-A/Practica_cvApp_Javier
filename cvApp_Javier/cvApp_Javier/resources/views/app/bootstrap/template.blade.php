<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'CV App')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
  <div class="container">
    <a class="navbar-brand" href="{{ route('main') }}">CV App</a>
    <div>
      <a class="nav-link d-inline text-white" href="{{ route('main') }}">Inicio</a>
      <a class="nav-link d-inline text-white" href="{{ route('curriculum.index') }}">Alumnos</a>
      <a class="nav-link d-inline text-white" href="{{ route('curriculum.create') }}">Nuevo Alumno</a>
      <a class="nav-link d-inline text-white" href="{{ route('curriculum.about') }}">Acerca</a>
    </div>
  </div>
</nav>

<div class="container">
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
