<div class="collapse navbar-collapse  w-auto" id="sidenav-collapse-main">

    <ul class="navbar-nav">

        {{-- Panel Principal --}}
        <li class="nav-item">
            <a class="nav-link  @if (Route::currentRouteName() === 'dashboard') active @endif" href="{{ route('dashboard') }}">
                <div
                    class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Panel Principal</span>
            </a>
        </li>

        {{-- Gestion Certificado --}}
        <li class="nav-item">
            <a class="nav-link @if (Route::currentRouteName() === 'seccionFormulario') active @endif" href="{{route('seccionFormulario')}}">
                <div
                    class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fa fa-address-card text-info text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Formulario Contacto</span>
            </a>
        </li>

        {{-- Gestion Clientes --}}
        <li class="nav-item">
            <a class="nav-link @if (Route::currentRouteName() === 'cliente') active @endif" href="{{route('cliente')}}">
                <div
                    class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fa fa-users text-success text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Gestion Clientes</span>
            </a>
        </li>

        {{-- Gestion Cursos --}}
        <li class="nav-item">
            <a class="nav-link @if (Route::currentRouteName() === 'cursos') active @endif" href="{{route('cursos')}}">
                <div
                    class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fa fa-file-text-o text-danger text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Gestion Cursos</span>
            </a>
        </li>

        {{-- Gestion Preinscripciones --}}
        <li class="nav-item">
            <a class="nav-link @if (Route::currentRouteName() === 'preinscripciones') active @endif" href="{{route('preinscripciones')}}">
                <div
                    class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fa fa-graduation-cap text-info text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Gestion Preinscripciones</span>
            </a>
        </li>

        {{-- Gestion Certificado --}}
        <li class="nav-item">
            <a class="nav-link @if (Route::currentRouteName() === 'certificados') active @endif" href="{{route('certificados')}}">
                <div
                    class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fa fa-address-card text-warning text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Gestion Certificado</span>
            </a>
        </li>

        {{-- Administradores --}}
        <li class="nav-item">
            <a class="nav-link @if (Route::currentRouteName() === 'administrador') active @endif" href="{{route('administrador')}}">
                <div
                    class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fa fa-user-secret text-success text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Administradores</span>
            </a>
        </li>

        <li class="nav-item mt-3">
            <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Configuracion de la cuenta</h6>
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
                    <span class="nav-link-text ms-1">Salir</span>
                </a>
            </form>
        </li>

    </ul>

</div>
