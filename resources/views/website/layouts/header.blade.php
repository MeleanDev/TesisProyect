<nav class="navbar navbar-expand-lg navbar-light fixed-top custom-navbar">
        <div class="container">
            <a class="navbar-brand" href="index.html">
                <div class="logo-container">
                    <img src="{{ asset('estilos/website/img/logo.png') }}" alt="Academia CADI Logo" class="logo" width="40" height="40">
                    <span>Academia CADI</span>
                </div>
            </a>
            <button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link @if (Request::is('/') ) active @endif" href="{{route('inicio')}}">Inicio</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle @if (Request::is('cursos/*') ) active @endif" href="#" id="cursosDropdown" role="button" data-bs-toggle="dropdown">
                            Cursos
                        </a>
                        <ul class="dropdown-menu custom-dropdown">
                            <li><a class="dropdown-item @if (Request::is('cursos/curso-empresa') ) active @endif" href="{{route('cursoEmpresa')}}">
                                <i class="fas fa-building me-2"></i>Cursos para Empresas
                            </a></li>
                            <li><a class="dropdown-item @if (Request::is('cursos/curso-menor') ) active @endif" href="{{route('cursoMenor')}}">
                                <i class="fas fa-child me-2"></i>Cursos para Menores
                            </a></li>
                            <li><a class="dropdown-item @if (Request::is('cursos/curso-ejecutivo') ) active @endif" href="{{route('cursoEjecutivo')}}">
                                <i class="fas fa-user-tie me-2"></i>Cursos Ejecutivos
                            </a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (Request::is('contacto') ) active @endif" href="{{route('contacto')}}">Contacto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (Request::is('preinscripcion') ) active @endif" href="{{route('preinscripcion')}}">Preinscripciones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">Verificar Certificado</a>
                    </li>
                    <li class="nav-item">
                        <button class="btn btn-outline-primary custom-btn-outline ms-2" data-bs-toggle="modal" data-bs-target="#loginModal">
                            <i class="fas fa-user me-1"></i>Login
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>