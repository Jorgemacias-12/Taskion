@php
  $id = $project['id'];
  $name = $project['Name'];
  $description = $project['Description'];
  $startDate = $project['StartDate'];
  $finishDate = new DateTime($project['FinishDate']);

  $actualDate = new DateTime();

  $difference = $actualDate->diff($finishDate);

  // Extraer componentes relevantes del objeto DateInterval
  $days = $difference->days;
  $hours = $difference->h;
  $minutes = $difference->i;
  $seconds = $difference->s;
@endphp

<article class="project-card">
    <h3 class="project-name">
      Proyecto {{ $name }}
    </h3>

    <p class="project-description">
      Descripción: {{ $description }}
    </p>

    <section class="project-dates">
        <p class="project-start">
          Fecha inicio: {{ $startDate }}
        </p>

        <p class="project-actual">
          Tiempo restante: {{ $days }} días, {{ $hours }} horas, {{ $minutes }} minutos, {{ $seconds }} segundos
        </p>

        <p class="project-finish">
            {{ $finishDate->format('Y-m-d') }}
        </p>
    </section>

    <section class="project-operations">
      <a class="project-operation" href="/app/projects/edit/{{$id}}" class="project-button">Editar</a>
      <a class="project-operation" href="/app/projects/delete/{{$id}}" class="project-button">Eliminar</a>
    </section>

</article>
