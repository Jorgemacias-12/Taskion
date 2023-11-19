<header class="header">
  <section class="header-wrapper">
    <section class="brand-container">
      <picture class="brand-icon-wrapper">
        <a href="/">
          <img src="https://via.placeholder.com/250x40" alt="" class="brand-icon">
        </a>
      </picture>
      <h1>Taskion</h1>
      <nav class="navigation">
        <ul class="nav-list">
          <li class="nav-item"><a href="" class="nav-link">Acerca de</a></li>
          <li class="nav-item"><a href="" class="nav-link">Contacto</a></li>
        </ul>
      </nav>
    </section>
    <nav class="navigation">
      <ul class="nav-list">

        @if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'])
          <li class="nav-item">
            <a href="/app" class="nav-link">
              Ir a la aplicación
            </a>
          </li>
        @endif

        <li class="nav-item"><a href="/login" class="nav-link">Iniciar sesión</a></li>
        <li class="nav-item">
          <a href="/register" class="nav-link">
            <span class="fas fa-user"></span>
            Registrarme
          </a>
      </li>
      </ul>
    </nav>
  </section>
</header>