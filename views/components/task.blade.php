@php
  $id = $task['id'];
  $name = $task['Name'];
  $description = $task['Description'];
  $startDate = $task['StartDate'];
  $finishDate = new DateTime($task['FinishDate']);
  $projectId =  $task['Project_id'];

  $actualDate = new DateTime();

  $difference = $actualDate->diff($finishDate);

  // Extraer componentes relevantes del objeto DateInterval
  $days = $difference->days;
  $hours = $difference->h;
  $minutes = $difference->i;
  $seconds = $difference->s;
@endphp

<article class="card">
  <h3 class="task-name">
    Tarea {{ $name }}
  </h3>

  <p class="task-description">
    Descripción: {{ $description }}
  </p>

  <section class="task-dates">
    <p class="task-start">
      Fecha inicio: {{ $startDate }}
    </p>

    <p class="task-actual">
      Tiempo restante: {{ $days }} días, {{ $hours }} horas, {{ $minutes }} minutos, {{ $seconds }} segundos
    </p>

    <p class="task-finish">
      Fecha fin: {{ $finishDate->format('Y-m-d') }}
    </p>
  </section>


  <section class="task-operations">
    <a class="card-operation" href="/app/tasks/edit/{{$id}}" class="task-operation">Editar</a>
    <a class="card-operation" href="/app/tasks/delete/{{$id}}" class="task-operation">Eliminar</a>
  </section>

</article>