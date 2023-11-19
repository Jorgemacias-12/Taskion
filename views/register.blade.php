@extends('base')

@section('title', 'Registrarse')

@push('styles')
  <link rel="stylesheet" href="/public/css/form.css">
@endpush

@push('scripts')
  <script defer src="/public/js/register.js"></script>
@endpush

@section('content')

  @if (isset($errors) && is_string($errors))
    @php
      $errors = unserialize($errors);
      $oldInput = $oldInput ?? [];
    @endphp
  @endif

  <section class="container flex col">
    <h2 class="title">Registro</h2>
  </section>
  <form id="form" class='form flex col' action="/register" method="POST" enctype="multipart/form-data">
    
    <section class="form-group">
      <label class='caption' for="name">Nombre</label>
      <input class='input' type="text" name="name" id="name" value="{{ $oldInput['name'] ?? '' }}">
      @if (isset($errors) && $errors->has('name'))
        <p class="error">
          <span class="close fas fa-times"></span>
          {{ $errors->first('name') }}
        </p>
      @endif
    </section>
    
    <section class="form-group">
      <label class='caption' for="username">Nombre de usuario</label>
      <input class='input' type="text" name="username" id="username" value="{{ $oldInput['username'] ?? '' }}">
      @if (isset($errors) && $errors->has('username'))
        <p class="error">
          <span class="close fas fa-times"></span>
          {{ $errors->first('username') }}
        </p>
      @endif
    </section>
    
    <section class="form-group">
      <label class='caption' for="email">Correo</label>
      <input class='input' type="email" name="email" id="email" value="{{ $oldInput['email'] ?? '' }}">
      @if (isset($errors) && $errors->has('email'))
        <p class="error">
          <span class="close fas fa-times"></span>
          {{ $errors->first('email') }}
        </p>
      @endif
    </section>
    
    <section class="form-group">
      <label class='caption' for="password">Contraseña</label>
      <input class='input' type="password" name="password" id="password" value="{{ $oldInput['password'] ?? '' }}">
      @if (isset($errors) && $errors->has('password'))
        <p class="error">
          <span class="close fas fa-times"></span>
          {{ $errors->first('password') }}
        </p>
      @endif
    </section>
    
    <section class="form-group">
      <label class='caption' for="avatar">Avatar</label>
      <input class='input-file' type="file" name="avatar" id="avatar" accept="image/png, image/gif, image/jpeg">
      @if (isset($errors) && $errors->has('avatar'))
        <p class="error">
          <span class="close fas fa-times"></span>
          {{ $errors->first('avatar') }}
        </p>
      @endif
    </section>

    {{-- No es necesario guardar y rellenar el valor del avatar porque los navegadores no mantienen los archivos seleccionados en las cargas después de la recarga de la página. --}}
    
    <section id="avatar-container" class="avatar-preview">
      <img id="avatar-img" class="avatar" src="" alt="Users avatar" />
    </section>

    <section class="form-group">
      <button class="button">
        Registrarme
      </button>
    </section>

  </form>
@endsection
