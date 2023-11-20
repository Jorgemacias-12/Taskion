<header class="header">
    <section class="header-wrapper">

        <section class="brand-container">
          <h1>
            Taskion - Dashboard
          </h1>
        </section>

        <section class="user-container flex row">

            <section class="user-info flex row">
                <p class="username">
                    {{ $user->getUsername() }} 
                </p>

                <img class="avatar" title="user avatar" src="data:image/png;base64,{{ $user->getAvatar() }}"
                    alt="user avatar">
            </section>

            <section class="user-config-container">
                <span class="opener fas fa-cog fa-2x"></span>
                <ul class="dropdown">
                    <li class="dropdown-item">
                      <a href="/app" class="dropdown-link">
                        <span class="fas fa-home"></span>
                        Ir al inicio
                      </a>
                    </li>
                    <li class="dropdown-item">
                      <a href="/app/projects" class="dropdown-link">
                        <span class="fas fa-folder"></span>
                        Ver proyectos
                      </a>
                    </li>
                    <li class="dropdown-item">
                      <a href="/app/tasks" class="dropdown-link">
                        <span class="fas fa-list"></span>
                        Ver tareas
                      </a>
                    </li>
                    <li class="dropdown-item">
                      <a href="/app/user" class="dropdown-link">
                        <span class="fas fa-user"></span>
                        Mi perfil
                      </a>
                    </li>
                    <li class="dropdown-item">
                      <a href="/app?logout" class="dropdown-link">
                        <span class="fas fa-sign-out-alt"></span>
                        Cerrar sesión
                      </a>
                    </li>
                </ul>
            </section>
        </section>
    </section>
</header>
