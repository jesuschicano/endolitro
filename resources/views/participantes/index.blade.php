@extends('layouts.app')

@section('content')
  <h2 class="text-center">Listado de participantes en la aplicación</h2>

  <hr>


  <table class="hover">
    <thead>
      <tr>
        <th>Nombre</th>
        <th>Apellidos</th>
        <th>E-mail</th>
        <th>Activo</th>
        <th>Edición</th>
      </tr>
    </thead>
    <tbody>
      @foreach($participantes as $p)
        <tr>
          <td>{{ $p->nombre }}</td>
          <td>{{ $p->apellidos }}</td>
          <td>{{ $p->email }}</td>
          <td>
            @if($p->activo == '1')
              <a href="participantes/actdes/{{$p->id}}" class="clear button success">
                <i class="fas fa-eye"></i>
              </a>
            @else
              <a href="participantes/actdes/{{$p->id}}" class="clear button secondary">
                <i class="fas fa-eye-slash"></i>
              </a>
            @endif
          </td>
          <td>
            <a href="{{ route('participantes.edit', $p->id) }}" class="button warning" title="Editar">
              <i class="fas fa-edit"></i>
            </a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection
