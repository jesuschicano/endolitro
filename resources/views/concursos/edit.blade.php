@extends('layouts.app')

@section('content')
<h2 class="text-center">Editar concurso</h2>
<h4 class="text-center"><small>{{ $concurso->nombre }}</small></h4>
<hr>

@if($errors->any())
  <div class="callout alert">
    <dl>
      @foreach($errors->all() as $error)
        <dt>{{ $error }}</dt>
      @endforeach
    </dl>
  </div>
@elseif(session('status'))
  <div class="callout warning">
    {{ session('status') }}
  </div>
@endif

<div class="container callout">
  <form method="post" action="{{ route('concursos.update', $concurso->id) }}">
    @csrf
    @method('PUT')
    <div class="grid-x grid-padding-x">
      <div class="small-12 medium-6 medium-offset-3 cell">
        <label>Nombre / Lugar / Evento</label>
        <input name="nombre" type="text" required value="{{ $concurso->nombre }}">
      </div>
    </div>
    <div class="grid-x grid-padding-x">
      <div class="small-12 medium-3 medium-offset-3 cell">
        <label>Fecha de Inicio</label>
        <input name="inicio" type="date" required value="{{ $concurso->inicio }}">
      </div>
      <div class="small-12 medium-3 cell">
        <label>Fecha de Fin</label>
        <input name="fin" type="date" required value="{{ $concurso->fin }}">
      </div>
    </div>

    <!-- AGREGAR PARTICIPANTES AL CONCURSO -->
    <div class="grid-x grid-padding-x">
      <div class="cell small-12 medium-4 medium-offset-4">
        @if( count($concurso->participantes) == 0 )
          <p class="callout warning text-center">No tiene participantes aún</p>
        @endif
        <label>Añadir un participante del listado:</label>
        <select name="participante">
          <option value="" selected>Selecciona del listado</option>
          @foreach($participantes as $p)
          <option value="{{ $p->id }}">
            {{ $p->nombre }} {{ $p->apellidos }}
          </option>
          @endforeach
        </select>
      </div>
    </div>

    <div class="grid-x grid-padding-x">
      <div class="cell small-12 medium-2 medium-offset-5">
        <button class="button expanded warning" type="submit">Actualizar cambios</button>
      </div>
    </div>
  </form>
</div>

<!-- TABLA DE PARTICIPANTES -->
<h4 class="text-center">Borrachuzos inscritos en el concurso</h4>

@if( count($concurso->participantes) > 0 )
  <table class="striped stack">
    <thead>
      <tr>
        <td>Nombre</td>
        <td>Añadir puntos</td>
        <td>Puntuación total</td>
      </tr>
    </thead>
    <tbody>
      @foreach($concurso->participantes as $p)
        <tr>
          <td>{{ $p->nombre }} {{ $p->apellidos }}</td>
          <td>
            <div class="button-group">
              <a href="{!! action('ConcursoController@addPoints', ['concurso_id'=>$concurso->id, 'participante_id'=>$p->id, 'puntuacion'=>1]) !!}" class="button" title="Tercio +1">
                <img src="{{ url('/') }}/img/bottle.png" alt="tercio"> + 1
              </a>
              <a href="{!! action('ConcursoController@addPoints', ['concurso_id'=>$concurso->id, 'participante_id'=>$p->id, 'puntuacion'=>2]) !!}" class="button" title="Jarra +2">
                <img src="{{ url('/') }}/img/beer-jar.png" alt="jarra"> + 2
              </a>
              <a href="{!! action('ConcursoController@addPoints', ['concurso_id'=>$concurso->id, 'participante_id'=>$p->id, 'puntuacion'=>3]) !!}" class="button" title="Copa +3">
                <img src="{{ url('/') }}/img/cocktail.png" alt="copa"> + 3
              </a>
              <a href="{!! action('ConcursoController@addPoints', ['concurso_id'=>$concurso->id, 'participante_id'=>$p->id, 'puntuacion'=>2]) !!}" class="button" title="Chupito +2">
                <img src="{{ url('/') }}/img/tequila-shot.png" alt="chupito"> + 2
              </a>
            </div>
          </td>
          <td>{{ $p->pivot->puntuacion }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endif

<div class="grid-x grid-padding-x">
  <div class="cell small-12 medium-2 medium-offset-5">
    <form action="{!! action('ConcursoController@cerrar', ['id' => $concurso->id]) !!}" method="post">
      @csrf
      <button type="submit" class="button expanded alert">Cerrar concurso</button>
    </form>
  </div>
</div>

@endsection
