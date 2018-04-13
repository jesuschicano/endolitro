@extends('layouts.app')

@section('content')
  <h2 class="text-center">Dar de alta a un nuevo borracho</h2>
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
    <form method="post" action="{{ route('participantes.store') }}">
      @csrf
      <div class="grid-x grid-padding-x">
        <div class="small-12 medium-6 cell">
          <label>Nombre</label>
          <input name="nombre" type="text" required autofocus value="{{ old('nombre') }}">
        </div>
        <div class="small-12 medium-6 cell">
          <label>Apellidos</label>
          <input name="apellidos" type="text" required value="{{ old('apellidos') }}">
        </div>
      </div>
      <div class="grid-x grid-padding-x">
        <div class="small-12 cell">
          <label>E-mail</label>
          <input name="email" type="email" required value="{{ old('email') }}">
        </div>
      </div>
      <div class="grid-x grid-padding-x">
        <button class="button expanded" type="submit">Crear</button>
      </div>
    </form>
  </div>

@endsection
