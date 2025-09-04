<div class="collapse navbar-collapse  w-auto" id="sidenav-collapse-main">

    <ul class="navbar-nav">

        {{-- Panel Principal --}}
        <li class="nav-item">
            <a class="nav-link @if (Route::currentRouteName() === 'dashboard') active @endif" href="{{ route('dashboard') }}">
                <div
                    class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Painel principal</span>
            </a>
        </li>

        {{-- Productos --}}
        <li class="nav-item">
            <a class="nav-link @if (Route::currentRouteName() === 'pedidos') active @endif" href="{{ route('pedidos') }}">
                <div
                    class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-bag-17 text-success text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Pedidos</span>
            </a>
        </li>

        {{-- Productos --}}
        <li class="nav-item">
            <a class="nav-link @if (Route::currentRouteName() === 'productos') active @endif" href="{{ route('productos') }}">
                <div
                    class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-box-2 text-danger text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Productos</span>
            </a>
        </li>

        {{-- Post --}}
        <li class="nav-item">
            <a class="nav-link @if (Route::currentRouteName() === 'post') active @endif" href="{{ route('post') }}">
                <div
                    class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-collection text-warning text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Post</span>
            </a>
        </li>

        {{-- Clientes --}}
        <li class="nav-item">
            <a class="nav-link @if (Route::currentRouteName() === 'clientes') active @endif" href="{{ route('clientes') }}">
                <div
                    class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fas fa-users text-info text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Clientes</span>
            </a>
        </li>

        {{-- Administrador --}}
        <li class="nav-item">
            <a class="nav-link @if (Route::currentRouteName() === 'administradores') active @endif" href="{{ route('administradores') }}">
                <div
                    class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-single-02 text-success text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Administradores</span>
            </a>
        </li>

        <li class="nav-item mt-3">
            <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Configurações de Conta</h6>
        </li>

        {{-- Cerrar Sesion --}}
        <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a class="nav-link " href="{{ route('logout') }}"
                    onclick="event.preventDefault();
            this.closest('form').submit();">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-button-power text-danger text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Sair</span>
                </a>
            </form>
        </li>

    </ul>

</div>
