<aside class="sidebar-container">
  <div class="brand-header">
    <div class="float-left pt-4 text-muted sidebar-close">
      <em class="ion-arrow-left-c icon-lg"></em>
    </div>
    <a class="brand-header-logo" href="#">
      <!-- Logo Image-->
      <img src="/img/logo.png", alt="logo"/>
    </a>
  </div>
  <div class="sidebar-content">
    <nav class="sidebar-nav">
      <ul>
        <li class="{{ Request::is('home') ? 'active' : '' }}">
          <a href="{{ url('home') }}">
            <span class="float-right nav-label"></span>
            <span class="nav-icon">
              <em class="ion-ios-speedometer-outline"></em>
            </span>
            <span>Dashboard</span>
          </a>
        </li>
        <li>
          <div class="sidebar-nav-heading">Reproducción y Cría</div>
        </li>
        <li>
          <a href="#">
            <span class="float-right nav-caret">
              <em class="ion-ios-arrow-right"></em>
            </span>
            <span class="float-right nav-label"></span>
            <span class="nav-icon">
              <em class="ion-social-octocat"></em>
            </span>
            <span>Reproductores</span>
          </a>
          <ul class="sidebar-subnav" id="elements">
            <li>
              <a href="{{ url('females') }}">
                <span class="float-right nav-label"></span>
                <span>Hembras</span>
              </a>
            </li>
            <li>
              <a href="{{ url('males') }}">
                <span class="float-right nav-label"></span>
                <span>Machos</span>
              </a>
            </li>
          </ul>
        </li>
        <li>
          <a href="#">
            <span class="float-right nav-caret">
              <em class="ion-ios-arrow-right"></em>
            </span>
            <span class="float-right nav-label"></span>
            <span class="nav-icon">
              <em class="ion-clipboard"></em>
            </span>
            <span>Eventos</span>
          </a>
          <ul class="sidebar-subnav">
            <li>
              <a href="{{ url('inseminations/create') }}">
                <span class="float-right nav-label"></span>
                <span>Inseminación</span>
              </a>
            </li>
            <li>
              <a href="{{ url('weanings/create') }}">
                <span class="float-right nav-label"></span>
                <span>Destete</span>
              </a>
            </li>
            <li>
              <a href="{{ url('abortions/create') }}">
                <span class="float-right nav-label"></span>
                <span>Aborto</span>
              </a>
            </li>
            <li>
              <a href="{{ url('deaths/create') }}">
                <span class="float-right nav-label"></span>
                <span>Baja</span>
              </a>
            </li>
            <li>
              <a href="{{ url('births/create') }}">
                <span class="float-right nav-label"></span>
                <span>Parto</span>
              </a>
            </li>
            <li>
              <a href="forms.advanced.html">
                <span class="float-right nav-label"></span>
                <span>Baja de lactantes</span>
              </a>
            </li>
            <li>
              <a href="forms.advanced.html">
                <span class="float-right nav-label"></span>
                <span>Tratamiento</span>
              </a>
            </li>
            <li>
              <a href="forms.advanced.html">
                <span class="float-right nav-label"></span>
                <span>Adopción</span>
              </a>
            </li>
            <li>
              <a href="forms.advanced.html">
                <span class="float-right nav-label"></span>
                <span>Traslado</span>
              </a>
            </li>
            <li>
              <a href="forms.advanced.html">
                <span class="float-right nav-label"></span>
                <span>Extracción de semen</span>
              </a>
            </li>
          </ul>
        </li>
        @can('roles.index')
        <li class="{{ Request::is('calendar') ? 'active' : '' }}">
          <a href="{{ url('calendar') }}">
            <span class="float-right nav-label"></span>
            <span class="nav-icon">
              <em class="ion-android-calendar"></em>
            </span>
            <span>Calendario</span>
          </a>
        </li>
        @endcan
        <li>
          <a href="#">
            <span class="float-right nav-caret">
              <em class="ion-ios-arrow-right"></em>
            </span>
            <span class="float-right nav-label"></span>
            <span class="nav-icon">
              <em class="ion-settings"></em>
            </span>
            <span>Configuraciones</span>
          </a>
          <ul class="sidebar-subnav">
            <li>
              <a href="forms.standard.html">
                <span class="float-right nav-label"></span>
                <span>Fases</span>
              </a>
            </li>
            <li>
              <a href="forms.advanced.html">
                <span class="float-right nav-label"></span>
                <span>Ubicaciones</span>
              </a>
            </li>
            <li>
              <a href="forms.standard.html">
                <span class="float-right nav-label"></span>
                <span>Genéticas</span>
              </a>
            </li>
            <li>
              <a href="forms.standard.html">
                <span class="float-right nav-label"></span>
                <span>Roles</span>
              </a>
            </li>
            <li>
              <a href="forms.standard.html">
                <span class="float-right nav-label"></span>
                <span>Usuarios</span>
              </a>
            </li>
          </ul>
        </li>
        <li>
          <div class="sidebar-nav-heading">Engorde</div>
        </li>
        <li>
          <a href="#">
            <span class="float-right nav-caret">
              <em class="ion-ios-arrow-right"></em>
            </span>
            <span class="float-right nav-label"></span>
            <span class="nav-icon">
              <em class="ion-ios-keypad-outline"></em>
            </span><span>Grupos</span>
          </a>
          <ul class="sidebar-subnav" id="user">
            <li>
              <a href="{{ url('groups/create') }}">
                <span class="float-right nav-label"></span>
                <span>Registrar nuevo</span>
              </a>
            </li>
            <li>
              <a href="signup.html">
                <span class="float-right nav-label"></span>
                <span>Ver todos</span>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
  </div>
</aside>