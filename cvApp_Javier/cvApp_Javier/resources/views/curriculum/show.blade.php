@extends('app.bootstrap.template')

@section('title','Ficha Alumno')

@section('content')
<div class="row">
  <div class="col-md-4">
    <img src="{{ $curriculum->fotografia ? asset('storage/'.$curriculum->fotografia) : asset('assets/img/sin_foto.png') }}" class="img-fluid mb-3 rounded">
    @if($curriculum->pdf)
      <a href="{{ asset('storage/'.$curriculum->pdf) }}" class="btn btn-outline-primary" target="_blank">Descargar CV (PDF)</a>
    @endif
  </div>

  <div class="col-md-8">
    <h2>{{ $curriculum->nombre }} {{ $curriculum->apellidos }}</h2>
    <p><strong>Email:</strong> {{ $curriculum->correo }}</p>
    <p><strong>Teléfono:</strong> {{ $curriculum->telefono }}</p>
    <p><strong>Fecha de nacimiento:</strong> {{ $curriculum->fecha_nacimiento }}</p>
    <p><strong>Nota media:</strong> {{ $curriculum->nota_media }}</p>
    <hr>
    <p><strong>Experiencia:</strong><br>{{ $curriculum->experiencia }}</p>
    <p><strong>Formación:</strong><br>{{ $curriculum->formacion }}</p>
    <p><strong>Habilidades:</strong><br>{{ $curriculum->habilidades }}</p>
  </div>
</div>

<a href="{{ route('curriculum.index') }}" class="btn btn-secondary mt-3">Volver</a>
@endsection

