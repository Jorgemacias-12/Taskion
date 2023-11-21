@extends('base')

@section('title', 'Crear proyecto')

@push('styles')
  <link rel="stylesheet" href="/public/css/app.css">
  <link rel="stylesheet" href="/public/css/navigation.css">
  <link rel="stylesheet" href="/public/css/projects.css">
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

  @if (isset($errors) && is_string($errors))
    @php
      $errors = unserialize($errors);
    @endphp
  @endif

  <section class="create-project-container flex col">
    <h2 class="title">
      Crear proyecto
    </h2>

    <a href="/app/projects" class="link">
      <span class="fas fa-arrow-left"></span>
      Regresar a proyectos
    </a>

    <form action="/app/projects/{{ $endpoint === 'edit' ? 'edit/' . $projectId : $endpoint }}" method="post" class="form flex col" id="create-project">

      <input type="hidden" name="user_id" value={{ $user->getId() }}>

      <section class="form-group">
        <label for="" class="label">Nombre del proyecto</label>
        <input class="input" type="text" name="project_name" id="" value="{{ isset($project) ? $project->getName() : '' }}">
         @if (isset($errors) && $errors->has('name'))
          <p class="error">
            <span class="close fas fa-times"></span>
            {{ $errors->first('name') }}
          </p>
        @endif
      </section>

      <section class="form-group">
        <label for="" class="label">Descripción del proyecto</label>
        <input class="input" type="text" name="project_description" id="" value="{{ isset($project) ? $project->getDescription() : '' }}">
        @if (isset($errors) && $errors->has('description'))
          <p class="error">
            <span class="close fas fa-times"></span>
            {{ $errors->first('description') }}
          </p>
        @endif
      </section>

      <section class="form-group">
        <label for="" class="label">Fecha de inicio</label>
        <input class="input" type="date" name="project_startDate" id="" value="{{ isset($project) ? $project->getStartDate() : '' }}">
        @if (isset($errors) && $errors->has('startDate'))
          <p class="error">
            <span class="close fas fa-times"></span>
            {{ $errors->first('startDate') }}
          </p>
        @endif
      </section>
      
      <section class="form-group">
        <label for="" class="label">Fecha de termino</label>
        <input class="input" type="date" name="project_finishDate" id="" value="{{ isset($project) ? $project->getFinishDate() : '' }}">
        @if (isset($errors) && $errors->has('finishDate'))
          <p class="error">
            <span class="close fas fa-times"></span>
            {{ $errors->first('finishDate') }}
          </p>
        @endif
      </section>
  
      <section class="form-group">
        <button type="submit" class="button">
          Crear proyecto
        </button>
      </section>

    </form>

  </section>
@endsection
