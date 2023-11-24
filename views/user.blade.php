@extends('base')

@section('title', 'User info')

@push('styles')
  <link rel="stylesheet" href="/public/css/app.css">
  <link rel="stylesheet" href="/public/css/navigation.css">
  <link rel="stylesheet" href="/public/css/projects.css">
  <link rel="stylesheet" href="/public/css/user.css">
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
  <section class="profile-about">
    
    <picture>
      <img class="profile-avatar" title="user avatar" src="data:image/png;base64,{{ $user->getAvatar() }}"
                    alt="user avatar">
    </picture>

    <section class="profile-data">

      <h2 class="profile-name">
        {{ $user->getName() }}
      </h2>

      <h4 class="profile-username">
        <span class="fas fa-user"></span>
        {{ $user->getUsername() }}
      </h4>

      <a href="mailto:{{$user->getEmail()}}" class="profile-email">
        <span class="fas fa-envelope"></span>
        {{ $user->getEmail() }}
      </a>
      
    </section>
    
    <a href="/app/user/edit" class="profile-edit-button">
      Editar perfil
    </a>

  </section>

  <section class="user-projects-and-tasks">

    <h2>Proyectos y tareas</h2>

  </section>
@endsection