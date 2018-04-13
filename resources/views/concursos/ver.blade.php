@extends('layouts.app')

@section('content')

  <h1 class="text-center">{{ $concurso->nombre }}</h1>
  <h4 class="text-center">
    <small>
      <i class="fas fa-calendar-alt"></i> Del {{$concurso->inicio}} hasta {{$concurso->fin}}
    </small>
  </h4>
  <hr>

  <div class="callout primary">
    <h2 class="text-center">Clasificación y resultados</h2>

    @php
      $result = $concurso->participantes()
                        ->orderBy('puntuacion', 'desc')
                        ->get();
    @endphp

    <table>
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Puntuación</th>
        </tr>
      </thead>
      <tbody>
        @foreach($result as $p)
        <tr>
          <td>{{$p->nombre}} {{$p->apellidos}}</td>
          <td>{{$p->pivot->puntuacion}}</td>
        </tr>
        @endforeach

      </tbody>
    </table>
  </div>

  <a href="{{ url('concursos/' . $concurso->id . '/imprime') }}" class="button primary">
    <i class="fas fa-download"></i> Descargar PDF
  </a>

@endsection
