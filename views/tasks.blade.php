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
@endphp

@section('navigation')
  @include('components.navigation')
@endsection

@section('content')
  <h2 class="title">
    Tareas
  </h2>

  @if (isset($_GET['taskCreated']))
    <p class="success">
      <span class="close fas fa-times"></span>
      ¡Tarea creada correctamente!
    </p>
  @endif

  @if (isset($_GET['updatedTask']))
    <p class="success">
      <span class="close fas fa-times"></span>
      ¡Tarea actualizada correctamente!
    </p>
  @endif
  
  @if (isset($_GET['taskDeleted']))
    <p class="success">
      <span class="close fas fa-times"></span>
      ¡Tarea eliminada correctamente!
    </p>
  @endif

  <section class="links">
      
    <a href="/app/" class="link">
      <span class="fas fa-home"></span>
      Inicio
    </a>

    <a href="tasks/create" class="link">
      <span class="fas fa-plus"></span>
      Crear tarea
    </a>

  </section>

  <section class="flex col" id="projects">
    @if(isset($tasks))
      @foreach($tasks as $task)
        @include('components.task', ['tasks' => $task])
      @endforeach
    @endif
  </section>

@endsection