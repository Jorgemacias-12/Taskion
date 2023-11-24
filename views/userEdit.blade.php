@extends('base')

@section('title', 'Modificar perfil')

@push('styles')
  <link rel="stylesheet" href="/public/css/app.css">
  <link rel="stylesheet" href="/public/css/navigation.css">
@endpush

@push('scripts')
  <script defer src="/public/js/app.js"></script>
@endpush

@php
  $user = isset($_SESSION['user']) ? unserialize($_SESSION['user']) : null;  
@endphp

@section('navigation')
  @include('components.navigation')
@endsection

@section('content')

  <form action="/app/user/edit/{{$user->getId()}}" class="form flex col"
    enctype="multipart/form-data" method="POST">
    
    <section class="form-group">
      <label for="" class="caption">Nombre completo</label>
      <input type="text" name="" id="" class="input" value='{{$user->getName()}}'>
    </section>
    
    <section class="form-group">
      <label for="" class="caption">Nombre de usuario</label>
      <input type="text" name="" id="" class="input" value='{{$user->getUsername()}}'>
    </section>
    
    <section class="form-group">
      <label for="" class="caption">Correo electronico</label>
      <input type="text" name="" id="" class="input" value='{{$user->getUsername()}}'>
    </section>

    <section class="form-group">
      <label for="" class="caption">Avatar</label>
      <img class="profile-avatar" title="user avatar" src="data:image/png;base64,{{ $user->getAvatar() }}"
                    alt="user avatar">
      <input accept="image/png, image/gif, image/jpeg" type="file" name="avatar" id="avatar">
    </section>


  </form>

@endsection