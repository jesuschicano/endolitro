<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Styles -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { font-family: DejaVu Sans; }
  </style>
</head>
<body>
  <div class="container">

    <div class="row">
      <h1 class="text-center">{{ $concurso->nombre }}</h1>
      <h4 class="text-center">
        <small>
          <i class="fas fa-calendar-alt"></i> Del {{$concurso->inicio}} hasta {{$concurso->fin}}
        </small>
      </h4>
      <hr>
    </div>

    <div class="row">
    	<table class="table table-bordered">
        <thead>
          <tr>
            <th>Nombre del participante</th>
            <th>Puntuación final</th>
          </tr>
        </thead>
        <tbody>
          @foreach($result as $x)
            <tr>
              <td>{{ $x->nombre }} {{ $x->apellidos }}</td>
              <td>{{ $x->pivot->puntuacion }}</td>
            </tr>
          @endforeach
        </tbody>
    	</table>
    </div>

  </div><!-- .container -->
</body>
</html>
