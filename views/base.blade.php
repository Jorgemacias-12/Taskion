<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Taskion - @yield('title', '')</title>
  <script defer src="/public/js/initial.js"></script>
  @include('components.styles')

  @stack('styles')
  @stack('scripts')
</head>
<body>

  @yield('navigation')

  @includeWhen($showHeader, 'components.header')

  <main class="content">
    @yield('content')
  </main>
</body>
</html>