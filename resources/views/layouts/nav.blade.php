<div class="title-bar stacked-for-medium" data-responsive-toggle="res-menu" data-hide-for="medium">
  <!-- boton responsive -->
  <button class="menu-icon" data-toggle="res-menu"></button>
  <div class="title-bar-title">
    {{ config('app.name') }}
  </div>
</div>

<!-- menu responsive -->
<div class="top-bar" id="res-menu">
  <div class="top-bar-left">
    <div class="menu-text">
      {{ config('app.name') }}
    </div>
  </div>
  <div class="top-bar-right">
    <ul class="dropdown menu" data-dropdown-menu>
      <li>
        <a href="#">Concursos</a>
        <ul class="menu">
          <li><a href="{{ url('concursos') }}">Ver activos</a></li>
          <li><a href="{{ url('historial') }}">Historial</a></li>
          <li><a href="{{ url('concursos/create') }}">Crear</a></li>
        </ul>
      </li>
      <li>
        <a href="#">Participantes</a>
        <ul class="menu">
          <li><a href="{{ url('participantes/create') }}">Crear nuevo</a></li>
          <li><a href="{{ url('participantes') }}">Ver listado</a></li>
        </ul>
      </li>
    </ul>
  </div>
</div>
