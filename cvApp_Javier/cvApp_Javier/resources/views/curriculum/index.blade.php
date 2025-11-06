@extends('app.bootstrap.template')

@section('title','Listado de Alumnos')

@section('content')
<h2 class="mb-3">Listado de Alumnos</h2>

<a href="{{ route('curriculum.create') }}" class="btn btn-primary mb-3">Nuevo Alumno</a>

<table class="table table-bordered table-striped">
  <thead class="table-dark">
    <tr>
      <th>Nombre</th>
      <th>Correo</th>
      <th>Teléfono</th>
      <th>Nota media</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
    @foreach($curriculums as $curriculum)
    <tr>
      <td>{{ $curriculum->nombre }} {{ $curriculum->apellidos }}</td>
      <td>{{ $curriculum->correo }}</td>
      <td>{{ $curriculum->telefono }}</td>
      <td>{{ $curriculum->nota_media ?? '-' }}</td>
      <td>
        <a href="{{ route('curriculum.show', $curriculum->id) }}" class="btn btn-sm btn-info">Ver</a>
        <a href="{{ route('curriculum.edit', $curriculum->id) }}" class="btn btn-sm btn-warning">Editar</a>
        <form action="{{ route('curriculum.destroy', $curriculum->id) }}" method="POST" style="display:inline" onsubmit="return confirm('¿Eliminar alumno?');">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

{{-- Si usas paginate() en el controlador --}}
{{ $curriculums->links() ?? '' }}
@endsection


