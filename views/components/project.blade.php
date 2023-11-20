@php
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
</article>
