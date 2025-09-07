@extends('website.layouts.app')
@section('subtitulo', 'Inicio')
@section('descripcion', 'Academia CADI - Formación de calidad para empresas, menores y ejecutivos con metodología presencial innovadora.')
@section('keywords', 'Academia CADI, cursos para empresas, cursos para menores, cursos ejecutivos, formación presencial, capacitación corporativa, educación de calidad')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-background">
            <div class="hero-overlay"></div>
        </div>
        <div class="container">
            <div class="row align-items-center min-vh-100">
                <div class="col-lg-6">
                    <div class="hero-content">
                        <h1 class="hero-title">Transforma tu <span class="text-gradient">Futuro</span> con Nuestros Cursos
                        </h1>
                        <p class="hero-subtitle">Ofrecemos formación de calidad para empresas, menores y ejecutivos con
                            metodología presencial innovadora</p>
                        <div class="hero-buttons">
                            <a href="{{route('cursoEjecutivo')}}" class="btn btn-primary custom-btn-primary">
                                <i class="fas fa-rocket me-2"></i>Inscríbete Ahora
                            </a>
                            <button class="btn btn-outline-light custom-btn-outline-light" data-bs-toggle="modal"
                                data-bs-target="#cursosModal">
                                <i class="fas fa-search me-2"></i>Explorar Cursos
                            </button>
                        </div>
                        <div class="hero-stats">
                            <div class="stat-item">
                                <span class="stat-number">500+</span>
                                <span class="stat-label">Estudiantes</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number">50+</span>
                                <span class="stat-label">Empresas</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number">15+</span>
                                <span class="stat-label">Cursos</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-image">
                        <img src="{{asset('estilos/website/img/yo.png')}}" width="700" height="600" alt="Estudiantes aprendiendo" class="img-fluid">
                        <div class="floating-card card-1">
                            <i class="fas fa-chart-line"></i>
                            <span>Crecimiento Profesional</span>
                        </div>
                        <div class="floating-card card-2">
                            <i class="fas fa-users"></i>
                            <span>Trabajo en Equipo</span>
                        </div>
                        <div class="floating-card card-3">
                            <i class="fas fa-lightbulb"></i>
                            <span>Innovación</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Cursos Section -->
    <section id="cursos" class="courses-section">
        <div class="container">
            <div class="section-header text-center">
                <span class="section-badge">Nuestros Programas</span>
                <h2 class="section-title">Elige tu Camino de <span class="text-gradient">Aprendizaje</span></h2>
                <p class="section-subtitle">Descubre la modalidad que mejor se adapte a tus necesidades y objetivos
                    profesionales</p>
            </div>

            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="course-category-card">
                        <div class="card-image">
                            <img src="{{asset('estilos/website/img/yo.png')}}" height="250" width="400" alt="Cursos para Empresas">
                            <div class="card-overlay">
                                <div class="card-icon">
                                    <i class="fas fa-building"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-content">
                            <h3>Cursos para Empresas</h3>
                            <p>Capacitación corporativa especializada para potenciar el talento de tu organización y mejorar
                                la productividad.</p>
                            <ul class="feature-list">
                                <li><i class="fas fa-check"></i>Liderazgo y gestión</li>
                                <li><i class="fas fa-check"></i>Comunicación efectiva</li>
                                <li><i class="fas fa-check"></i>Productividad empresarial</li>
                                <li><i class="fas fa-check"></i>Trabajo en equipo</li>
                            </ul>
                            <div class="card-footer">
                                <span class="course-count">6 Cursos Disponibles</span>
                                <a href="{{route('cursoEmpresa')}}" class="btn btn-primary custom-btn-primary">
                                    Ver Cursos <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="course-category-card">
                        <div class="card-image">
                            <img src="{{asset('estilos/website/img/yo.png')}}" height="250" width="400" alt="Cursos para Menores">
                            <div class="card-overlay">
                                <div class="card-icon">
                                    <i class="fas fa-child"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-content">
                            <h3>Cursos para Menores</h3>
                            <p>Programas educativos diseñados especialmente para el desarrollo integral de niños y
                                adolescentes.</p>
                            <ul class="feature-list">
                                <li><i class="fas fa-check"></i>Programación para niños</li>
                                <li><i class="fas fa-check"></i>Robótica educativa</li>
                                <li><i class="fas fa-check"></i>Arte y creatividad</li>
                                <li><i class="fas fa-check"></i>Habilidades sociales</li>
                            </ul>
                            <div class="card-footer">
                                <span class="course-count">6 Cursos Disponibles</span>
                                <a href="{{route('cursoMenor')}}" class="btn btn-primary custom-btn-primary">
                                    Ver Cursos <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6"> 
                    <div class="course-category-card">
                        <div class="card-image">
                            <img src="{{asset('estilos/website/img/yo.png')}}" height="250" width="400" alt="Cursos Ejecutivos">
                            <div class="card-overlay">
                                <div class="card-icon">
                                    <i class="fas fa-user-tie"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-content">
                            <h3>Cursos Ejecutivos</h3>
                            <p>Formación de alto nivel para profesionales que buscan potenciar su carrera y liderazgo
                                empresarial.</p>
                            <ul class="feature-list">
                                <li><i class="fas fa-check"></i>MBA ejecutivo</li>
                                <li><i class="fas fa-check"></i>Estrategia empresarial</li>
                                <li><i class="fas fa-check"></i>Finanzas avanzadas</li>
                                <li><i class="fas fa-check"></i>Transformación digital</li>
                            </ul>
                            <div class="card-footer">
                                <span class="course-count">6 Cursos Disponibles</span>
                                <a href="{{route('cursoEjecutivo')}}" class="btn btn-primary custom-btn-primary">
                                    Ver Cursos <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="about-content">
                        <span class="section-badge">Sobre Nosotros</span>
                        <h2 class="section-title">¿Quiénes <span class="text-gradient">Somos?</span></h2>
                        <p class="about-description">Somos una academia líder en formación presencial con más de 10 años de
                            experiencia. Nos especializamos en ofrecer cursos de alta calidad para diferentes segmentos,
                            transformando vidas a través de la educación.</p>

                        <div class="features-grid">
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-award"></i>
                                </div>
                                <div class="feature-content">
                                    <h4>Instructores Certificados</h4>
                                    <p>Profesionales con amplia experiencia</p>
                                </div>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="feature-content">
                                    <h4>Metodología Presencial</h4>
                                    <p>Aprendizaje interactivo y personalizado</p>
                                </div>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-certificate"></i>
                                </div>
                                <div class="feature-content">
                                    <h4>Certificación Oficial</h4>
                                    <p>Reconocimiento académico garantizado</p>
                                </div>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-headset"></i>
                                </div>
                                <div class="feature-content">
                                    <h4>Seguimiento Personalizado</h4>
                                    <p>Acompañamiento durante todo el proceso</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-image">
                        <img src="{{asset('estilos/website/img/yo.png')}}" height="500" width="600" alt="Nuestra academia" class="img-fluid">
                        <div class="experience-badge">
                            <span class="experience-number">10+</span>
                            <span class="experience-text">Años de Experiencia</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <h3 class="stat-number counter" data-target="500">300</h3>
                        <p class="stat-label">Estudiantes Graduados</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-building"></i>
                        </div>
                        <h3 class="stat-number counter" data-target="50">300</h3>
                        <p class="stat-label">Empresas Capacitadas</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-book"></i>
                        </div>
                        <h3 class="stat-number counter" data-target="15">300</h3>
                        <p class="stat-label">Cursos Disponibles</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <h3 class="stat-number counter" data-target="10">300</h3>
                        <p class="stat-label">Años de Experiencia</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    @include('website.components.contacto')

    <!-- maps Section -->
    @include('website.components.googlemaps')

    <!-- Cursos Selection Modal -->
    <div class="modal fade" id="cursosModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content custom-modal">
                <div class="modal-header">
                    <h5 class="modal-title">Elige tu Tipo de Curso</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <a href="{{route('cursoEmpresa')}}" class="course-modal-card">
                                <div class="course-modal-icon">
                                    <i class="fas fa-building"></i>
                                </div>
                                <h5>Cursos para Empresas</h5>
                                <p>Capacitación corporativa</p>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{route('cursoMenor')}}" class="course-modal-card">
                                <div class="course-modal-icon">
                                    <i class="fas fa-child"></i>
                                </div>
                                <h5>Cursos para Menores</h5>
                                <p>Programas educativos</p>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{route('cursoEjecutivo')}}" class="course-modal-card">
                                <div class="course-modal-icon">
                                    <i class="fas fa-user-tie"></i>
                                </div>
                                <h5>Cursos Ejecutivos</h5>
                                <p>Formación profesional</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
