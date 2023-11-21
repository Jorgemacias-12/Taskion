@extends('base')

@section('title', 'Proyectos')

@push('styles')
  <link rel="stylesheet" href="/public/css/app.css">
  <link rel="stylesheet" href="/public/css/navigation.css">
  <link rel="stylesheet" href="/public/css/cards.css">
@endpush

@push('scripts')
  <script defer src="/public/js/app.js"></script>
@endpush

@php
  $user = isset($_SESSION['user']) ? unserialize($_SESSION['user']) : null;

  // var_dump($projects);
@endphp

@section('navigation')
  @include('components.navigation')
@endsection

@section('content')
  <h2 class="title">
    Proyectos
  </h2>

  @if (isset($_GET['projectCreated']))
    <p class="success">
      <span class="close fas fa-times"></span>
      ¡Proyecto creado correctamente!
    </p>
  @endif

  @if (isset($_GET['projectUpdated']))
    <p class="success">
      <span class="close fas fa-times"></span>
      ¡Proyecto actualizado!
    </p>
  @endif

  @if (isset($_GET['projectDeleted']))
    <p class="success">
      <span class="close fas fa-times"></span>
      ¡Proyecto eliminado!
    </p>
  @endif

  <section class="links">
    
    <a href="/app/" class="link">
      <span class="fas fa-home"></span>
      Inicio
    </a>
    
    <a href="projects/create" class="link">
      <span class="fas fa-plus"></span>
      Crear proyecto
    </a>

  </section>

  <section class="flex col" id="projects">
    @if(isset($projects))
      @foreach($projects as $project => $value)
        @include('components.project', ['project' => $value])
      @endforeach
    @endif
  </section>

@endsection