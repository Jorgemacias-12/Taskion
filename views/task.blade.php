@extends('base')

@section('title', 'Crear tarea')

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

  if ($endpoint !== "edit") {
    $projects = unserialize($projects);
  }
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

  <section class="create-task-container flex col">

    <h2 class="title">
      {{ $endpoint !== "create" ?  'Editar tarea' : 'Crear tarea' }}
    </h2>

    <a href="/app/tasks" class="link">
      <span class="fas fa-arrow-left"></span>
      Regresar a tareas
    </a>

    <form action="/app/tasks/{{ $endpoint === 'edit' ? 'edit/' . $taskId : 'create' }}" class="form" method="post" id="create-task">

      <input type="hidden" name="user_id" value="{{ $user->getId() }}">

      <section class="form-group">
        <label for="" class="caption">Proyecto</label>
        <select class="select" name="project_id" id="project-id">
          <option value="" selected disable>Selecciona un proyecto</option>
          @foreach ($projects as $project => $projectValue)
            <option value="{{ $projectValue['id'] }}">{{ $projectValue['Name'] }}</option>
          @endforeach
        </select>
        @if (isset($errors) && $errors->has('project'))
          <p class="error">
            <span class="close fas fa-times"></span>
            {{ $errors->first('project') }}
          </p>
        @endif
      </section>

      <section class="form-group">
        <label for="" class="caption">Nombre</label>
        <input class="input" type="text" name="task_name" id="" value="{{ isset($task) ? $task->getName() : '' }}">
        @if (isset($errors) && $errors->has('name'))
          <p class="error">
            <span class="close fas fa-times"></span>
            {{ $errors->first('name') }}
          </p>
        @endif
      </section>
      
      <section class="form-group">
        <label for="" class="caption">Descripción</label>
        <input class="input" type="text" name="task_description" id="" value="{{ isset($task) ? $task->getDescription() : '' }}">
        @if (isset($errors) && $errors->has('description'))
          <p class="error">
            <span class="close fas fa-times"></span>
            {{ $errors->first('description') }}
          </p>
        @endif
      </section>

      <section class="form-group">
        <label for="" class="label">Fecha de inicio</label>
        <input class="input" type="date" name="task_startDate" id="" value="{{ isset($task) ? $task->getStartDate() : '' }}">
        @if (isset($errors) && $errors->has('startDate'))
          <p class="error">
            <span class="close fas fa-times"></span>
            {{ $errors->first('startDate') }}
          </p>
        @endif
      </section>
      
      <section class="form-group">
        <label for="" class="label">Fecha de termino</label>
        <input class="input" type="date" name="task_finishDate" id="" value="{{ isset($task) ? $task->getFinishDate() : '' }}">
        @if (isset($errors) && $errors->has('finishDate'))
          <p class="error">
            <span class="close fas fa-times"></span>
            {{ $errors->first('finishDate') }}
          </p>
        @endif
      </section>

      <section class="form-group">
        <button class="button" type="submit">
          {{ $endpoint !== "create" ?  'Editar tarea' : 'Crear tarea' }}
        </button>
      </section>

    </form>

  </section>

@endsection
