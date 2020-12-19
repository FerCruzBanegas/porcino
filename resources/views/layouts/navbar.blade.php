<header class="header-container">
  <nav>
    <ul class="d-lg-none">
      <li>
        <a class="sidebar-toggler menu-link menu-link-close" href="#">
          <span><em></em></span>
        </a>
      </li>
    </ul>
    <ul class="d-none d-sm-block">
      <li>
        <a class="covermode-toggler menu-link menu-link-close" href="#">
          <span><em></em></span>
        </a>
      </li>
    </ul>
    <h2 class="header-title">{{ Auth::user()->name }}</h2>
    <ul class="float-left">
      <li>
        <a id="header-search" href="#">
          <em class="ion-ios-search-strong"></em>
        </a>
      </li>
      <li class="dropdown">
        <a href="#" data-toggle="dropdown">
          <em class="ion-android-notifications"></em>
          <sup class="badge bg-danger">3</sup>
        </a>
        <div class="dropdown-menu dropdown-menu-left dropdown-scale dropdown-card">
          <h6 class="dropdown-header">User menu</h6>
          <a class="dropdown-item" href="#">
            <span class="float-right badge badge-primary">4</span>
            <em class="ion-ios-email-outline icon-lg text-primary"></em>
            Messages
          </a>
          <a class="dropdown-item" href="#">
            <em class="ion-ios-gear-outline icon-lg text-primary"></em>
            Settings
          </a>
          <div class="dropdown-divider" role="presentation"></div>
          <a class="dropdown-item" href="user.login.html">
            <em class="ion-log-out icon-lg text-primary"></em>
            Logoff
          </a>
        </div>
      </li>
    </ul>
    <ul class="float-right">
      <li class="dropdown">
        <a class="dropdown-toggle has-badge" href="#" data-toggle="dropdown">
          <img class="header-user-image" src="/img/nano.jpg" alt="header-user-image">
        </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-scale">
          <h6 class="dropdown-header">User menu</h6>
          <a class="dropdown-item" href="#">
            <span class="float-right badge badge-primary">4</span>
            <em class="ion-ios-email-outline icon-lg text-primary"></em>
            Messages
          </a>
          <a class="dropdown-item" href="#">
            <em class="ion-ios-gear-outline icon-lg text-primary"></em>
            Settings
          </a>
          <div class="dropdown-divider" role="presentation"></div>
          <a 
            class="dropdown-item" href="{{ route('logout') }}"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            <em class="ion-log-out icon-lg text-primary"></em>
            {{ __('Cerrar Sesión') }}
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
        </div>
      </li>
    </ul>
  </nav>
</header>