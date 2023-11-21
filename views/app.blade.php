@extends('base')

@section('title', 'App')

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

  <section class="links">
    <a href="/app/projects" class="link">
      <span class="fas fa-folder"></span>
      Ir a proyectos
    </a>
    <a href="/app/tasks" class="link">
      <span class="fas fa-list"></span>
      Ir a tareas
    </a>
  </section>

  <section class="container projects">

    <h2>
      Proyectos creados por tí
    </h2>

    <section class="flex col" id="projects">
      @if(isset($projects))
        @foreach($projects as $project => $value)
          @include('components.project', ['project' => $value])
        @endforeach
      @endif
    </section>

  </section>

  <section class="container tasks">
    <h2>
      Tareas creadas por tí
    </h2>

    <section class="flex col" id="tasks">
      @if(isset($tasks))
        @foreach($tasks as $task)
          @include('components.task', ['task' => $task])
        @endforeach
      @endif
    </section>

  </section>

@endsection