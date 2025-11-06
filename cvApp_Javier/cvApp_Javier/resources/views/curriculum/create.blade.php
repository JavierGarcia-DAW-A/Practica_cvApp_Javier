@extends('app.bootstrap.template')

@section('title','Nuevo Alumno')

@section('content')
<h2>Registrar Alumno</h2>

<form action="{{ route('curriculum.store') }}" method="POST" enctype="multipart/form-data">
  @csrf
  <div class="row">
    <div class="col-md-6 mb-3">
      <label class="form-label">Nombre</label>
      <input type="text" name="nombre" class="form-control" required>
    </div>
    <div class="col-md-6 mb-3">
      <label class="form-label">Apellidos</label>
      <input type="text" name="apellidos" class="form-control" required>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6 mb-3">
      <label class="form-label">Correo</label>
      <input type="email" name="correo" class="form-control" required>
    </div>
    <div class="col-md-6 mb-3">
      <label class="form-label">Teléfono</label>
      <input type="text" name="telefono" class="form-control">
    </div>
  </div>

  <div class="row">
    <div class="col-md-6 mb-3">
      <label class="form-label">Fecha de nacimiento</label>
      <input type="date" name="fecha_nacimiento" class="form-control">
    </div>
    <div class="col-md-6 mb-3">
      <label class="form-label">Nota media</label>
      <input type="number" step="0.01" name="nota_media" class="form-control">
    </div>
  </div>

  <div class="mb-3">
    <label class="form-label">Experiencia</label>
    <textarea name="experiencia" class="form-control"></textarea>
  </div>

  <div class="mb-3">
    <label class="form-label">Formación</label>
    <textarea name="formacion" class="form-control"></textarea>
  </div>

  <div class="mb-3">
    <label class="form-label">Habilidades</label>
    <textarea name="habilidades" class="form-control"></textarea>
  </div>

  <div class="mb-3">
    <label class="form-label">Fotografía</label>
    <input type="file" name="fotografia" class="form-control" accept="image/*">
  </div>

  <div class="mb-3">
    <label class="form-label">Currículum (PDF)</label>
    <input type="file" name="pdf" class="form-control" accept="application/pdf">
  </div>

  <button type="submit" class="btn btn-success">Guardar</button>
  <a href="{{ route('curriculum.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
