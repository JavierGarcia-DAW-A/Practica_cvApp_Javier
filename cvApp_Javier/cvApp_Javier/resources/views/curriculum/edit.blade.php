@extends('app.bootstrap.template')

@section('title','Editar Alumno')

@section('content')
<h2>Editar Alumno</h2>

<form action="{{ route('curriculum.update', $curriculum->id) }}" method="POST" enctype="multipart/form-data">
  @csrf
  @method('PUT')

  <div class="row">
    <div class="col-md-6 mb-3">
      <label class="form-label">Nombre</label>
      <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $curriculum->nombre) }}">
    </div>
    <div class="col-md-6 mb-3">
      <label class="form-label">Apellidos</label>
      <input type="text" name="apellidos" class="form-control" value="{{ old('apellidos', $curriculum->apellidos) }}">
    </div>
  </div>

  <div class="row">
    <div class="col-md-6 mb-3">
      <label class="form-label">Correo</label>
      <input type="email" name="correo" class="form-control" value="{{ old('correo', $curriculum->correo) }}">
    </div>
    <div class="col-md-6 mb-3">
      <label class="form-label">Teléfono</label>
      <input type="text" name="telefono" class="form-control" value="{{ old('telefono', $curriculum->telefono) }}">
    </div>
  </div>

  <div class="row">
    <div class="col-md-6 mb-3">
      <label class="form-label">Fecha de nacimiento</label>
      <input type="date" name="fecha_nacimiento" class="form-control" value="{{ old('fecha_nacimiento', $curriculum->fecha_nacimiento) }}">
    </div>
    <div class="col-md-6 mb-3">
      <label class="form-label">Nota media</label>
      <input type="number" step="0.01" name="nota_media" class="form-control" value="{{ old('nota_media', $curriculum->nota_media) }}">
    </div>
  </div>

  <div class="mb-3">
    <label class="form-label">Experiencia</label>
    <textarea name="experiencia" class="form-control">{{ old('experiencia', $curriculum->experiencia) }}</textarea>
  </div>

  <div class="mb-3">
    <label class="form-label">Formación</label>
    <textarea name="formacion" class="form-control">{{ old('formacion', $curriculum->formacion) }}</textarea>
  </div>

  <div class="mb-3">
    <label class="form-label">Habilidades</label>
    <textarea name="habilidades" class="form-control">{{ old('habilidades', $curriculum->habilidades) }}</textarea>
  </div>

  <div class="mb-3">
    <label class="form-label">Fotografía actual</label><br>
    @if($curriculum->fotografia)
      <img src="{{ asset('storage/'.$curriculum->fotografia) }}" class="img-thumbnail mb-2" width="150">
    @endif
    <input type="file" name="fotografia" class="form-control" accept="image/*">
  </div>

  <div class="mb-3">
    <label class="form-label">CV (PDF) actual</label><br>
    @if($curriculum->pdf)
      <a href="{{ asset('storage/'.$curriculum->pdf) }}" target="_blank">{{ basename($curriculum->pdf) }}</a>
    @endif
    <input type="file" name="pdf" class="form-control" accept="application/pdf">
  </div>

  <button type="submit" class="btn btn-success">Actualizar</button>
  <a href="{{ route('curriculum.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
