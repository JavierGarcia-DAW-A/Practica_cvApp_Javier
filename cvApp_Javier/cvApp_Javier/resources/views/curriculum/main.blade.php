@extends('app.bootstrap.template')

@section('title','Inicio')

@section('content')
<h1 class="mb-4">Últimos Alumnos</h1>

<div class="row">
@foreach($curriculums as $alumno)
  <div class="col-md-4 mb-3">
    <div class="card">
      <img src="{{ $alumno->fotografia ? asset('storage/'.$alumno->fotografia) : asset('assets/img/sin_foto.png') }}" class="card-img-top" style="height:200px;object-fit:cover;">
      <div class="card-body">
        <h5>{{ $alumno->nombre }} {{ $alumno->apellidos }}</h5>
        <p class="mb-1"><strong>Nota:</strong> {{ $alumno->nota_media ?? 'N/A' }}</p>
        <a href="{{ route('curriculum.show', $alumno->id) }}" class="btn btn-primary">Ver CV</a>
      </div>
    </div>
  </div>
@endforeach
</div>
@endsection
