<header class="app-header">
  <a class="app-header__logo" href="{{ route('home') }}">Céos</a>
  <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
  <ul class="app-nav">
    <li class="dropdown">
      <a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu">
        <strong class="mr-3"> Olá, {{ $userName }} </strong>
        <i class="fa fa-user fa-lg"></i>
      </a>
      <ul class="dropdown-menu settings-menu dropdown-menu-right">
        <li>
          <a class="dropdown-item" href="{{ route('home') }}">
            <i class="fa fa-user fa-lg"></i> Minha Conta
          </a>
        </li>
        <li>
          <a class="dropdown-item" href="{{ route('home') }}">
            <i class="fa fa-lock fa-lg"></i> Trocar Senha
          </a>
        </li>
        <li>
          <form action="{{ route('logout') }}" method="POST">
            @csrf

            <button class="dropdown-item">
              <i class="fa fa-sign-out fa-lg"></i> Sair
            </button>
          </form>
        </li>
      </ul>
    </li>
  </ul>
</header>