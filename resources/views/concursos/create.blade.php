@extends('layouts.app')

@section('content')
  <h2 class="text-center">Crear un nuevo concurso</h2>
  <h4 class="text-center"><small>Que gane el más borracho</small></h4>
  <hr>

  @if($errors->any())
    <div class="callout alert">
      <dl>
        @foreach($errors->all() as $error)
          <dt>{{ $error }}</dt>
        @endforeach
      </dl>
    </div>
  @endif

  @if(session('status'))
    <div class="callout success text-center">
      {{ session('status') }}
    </div>
  @endif

  <div class="callout">
    <form method="post" action="{{ route('concursos.store') }}">
      @csrf
      <div class="grid-x grid-padding-x">
        <div class="small-12 medium-6 medium-offset-3 cell">
          <label>Nombre / Lugar / Evento</label>
          <input name="nombre" type="text" required autofocus>
        </div>
      </div>
      <div class="grid-x grid-padding-x">
        <div class="small-12 medium-3 medium-offset-3 cell">
          <label>Fecha de Inicio</label>
          <input name="inicio" type="date" required>
        </div>
        <div class="small-12 medium-3 cell">
          <label>Fecha de Fin</label>
          <input name="fin" type="date" required>
        </div>
      </div>
      <div class="grid-x grid-padding-x">
        <div class="cell small-12 medium-2 medium-offset-5">
          <button class="button expanded" type="submit">Crear</button>
        </div>
      </div>
    </form>
  </div>

@endsection
