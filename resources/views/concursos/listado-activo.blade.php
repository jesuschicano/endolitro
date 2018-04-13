@extends('layouts.app')

@section('content')
  <h2 class="text-center">Listado de concursos.<br><small>Solo activos</small></h2>

  <hr>

  <table class="hover">
    <thead>
      <tr>
        <th>Nombre/lugar</th>
        <th>Inicio</th>
        <th>Fin</th>
        <th>Nº participantes</th>
        <th>Editar</th>
      </tr>
    </thead>
    <tbody>
      @foreach($concursos as $c)
        <tr>
          <td>{{ $c->nombre }}</td>
          <td>{{ $c->inicio }}</td>
          <td>{{ $c->fin }}</td>
          <td>{{ $c->participantes->count() }}</td>
          <td>
            <a href="{{ route('concursos.edit', $c->id) }}" class="button warning" title="Editar">
              <i class="fas fa-edit"></i>
            </a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection
