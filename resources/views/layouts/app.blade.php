<!DOCTYPE html>
<html class="no-js" lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css">
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.4.3/css/foundation.min.css">
    <link rel="stylesheet" href="{{ url('/') }}/css/myApp.css">
</head>
<body>

  @include('layouts.nav')

  <main>
    @yield('content')
  </main>

  <!-- JQuery first, semantic next -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.4.3/js/foundation.min.js"></script>
  <script>
    $(document).foundation();
  </script>
</body>
</html>
