@extends('layouts.app')

@section('content')
  <h2 class="text-center">Historial de concursos.<br><small>Ya cerrados</small></h2>

  <hr>

  <table class="hover">
    <thead>
      <tr>
        <th>Nombre/lugar</th>
        <th>Inicio</th>
        <th>Fin</th>
        <th>Nº participantes</th>
        <th>Ver</th>
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
            <a href="{{ route('concursos.show', $c->id) }}" class="button primary" title="Editar">
              <i class="fas fa-search"></i>
            </a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection
