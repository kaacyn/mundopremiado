<ul class="nav navbar-nav">
  <li><a href="{{ URL::to('/') }}">Home</a></li>
  @if (Auth::check())
    <li @if (Request::is('sysadmin/promocoes*')) class="active" @endif>
      <a href="{{ URL::to('sysadmin/promocoes') }}" title="Produtos">Promoções</a>
    </li>
  @endif
</ul>

<ul class="nav navbar-nav navbar-right">
  @if (Auth::guest())
    <li><a href="auth/login" title="Login">Login</a></li>
  @else
    <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="{{ Auth::user()->name }}" role="button"
         aria-expanded="false">{{ Auth::user()->name }}
        <span class="caret"></span>
      </a>
      <ul class="dropdown-menu" role="menu">
        <li><a href="{{ URL::to('auth/logout') }}" title="Sair">Sair</a></li>
      </ul>
    </li>
  @endif
</ul>