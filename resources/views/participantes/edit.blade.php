@extends('layouts.app')

@section('content')

<h2 class="text-center">Edita este borracho</h2>
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
  <form method="post" action="{{ route('participantes.update', $participante->id) }}">
    @csrf
    @method('PUT')
    <div class="grid-x grid-padding-x">
      <div class="small-12 medium-6 cell">
        <label>Nombre</label>
        <input name="nombre" type="text" required autofocus value="{{ $participante->nombre }}">
      </div>
      <div class="small-12 medium-6 cell">
        <label>Apellidos</label>
        <input name="apellidos" type="text" required value="{{ $participante->apellidos }}">
      </div>
    </div>
    <div class="grid-x grid-padding-x">
      <div class="small-12 cell">
        <label>E-mail</label>
        <input name="email" type="email" required value="{{ $participante->email }}">
      </div>
    </div>
    <div class="grid-x grid-padding-x">
      <button class="button expanded" type="submit">Guardar</button>
    </div>
  </form>
</div>

@endsection
