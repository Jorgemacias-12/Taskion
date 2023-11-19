@extends('base')

@section('title', 'Iniciar sesión')

@push('styles')
  <link rel="stylesheet" href="/public/css/form.css">
@endpush

@section('content')

  <section class="container flex col">
    <h2 class="title">Login</h2>
  </section>

  <form action="/login" class="form flex col" method="POST">

    @if (isset($_GET['message']) && $_GET['message'] === "accountCreated")
      <p class="success">
        <span class="close fas fa-times"></span>
        ¡Cuenta creada correctamente!
      </p>
    @endif

    <section class="form-group">
      <label for="" class="caption">Email</label>
      <input class="input" type="text" name="email" id="email">
    </section>

    <section class="form-group">
      <label for="" class="caption">Contraseña</label>
      <input class="input" type="text" name="password" id="password">
    </section>

    <section class="form-group">
      <button class="button" type="submit">Iniciar sesión</button>
    </section>

  </form>

@endsection