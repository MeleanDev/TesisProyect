@extends('website.layouts.app')
@section('subtitulo', 'Cursos Ejecutivos')
@section('descripcion', 'Formación de alto nivel para profesionales que buscan potenciar su carrera.')
@section('keywords', 'cursos ejecutivos, formación profesional, desarrollo de liderazgo, habilidades directivas, capacitación empresarial, educación continua')

@section('content')
    <x-page-header titulo="Cursos Ejecutivos"
        subtitulo="Formación de alto nivel para profesionales que buscan potenciar su carrera."
        icono="fas fa-user-tie" :breadcrumb="[
            ['nombre' => 'Inicio', 'link' => 'index.html', 'activo' => false],
            ['nombre' => 'Cursos Ejecutivos', 'link' => null, 'activo' => true],
        ]" />

    <!-- Courses Section -->
    <section class="courses-listing-section">
        <div class="container">
            <div class="row g-4">
                <!-- Curso 1 -->
                <div class="col-lg-6">
                    <div class="course-card">
                        <div class="course-image">
                            <img src="yo.png" height="250" width="400" alt="Liderazgo y Gestión de Equipos">
                            <div class="course-badge">Destacado</div>
                            <div class="course-overlay">
                                <a href="curso-detalle.html" class="btn btn-primary custom-btn-primary">
                                    <i class="fas fa-eye me-2"></i>Ver Detalles
                                </a>
                            </div>
                        </div>
                        <div class="course-content">
                            <div class="course-meta">
                                <span class="course-category">
                                    <i class="fas fa-users-cog"></i>Liderazgo
                                </span>
                                <span class="course-duration">
                                    <i class="fas fa-clock"></i>40 horas
                                </span>
                            </div>
                            <h3 class="course-title">
                                <a href="curso-detalle.html">Liderazgo y Gestión de Equipos</a>
                            </h3>
                            <p class="course-description">Desarrolla habilidades de liderazgo efectivo y aprende a gestionar
                                equipos de alto rendimiento en entornos empresariales modernos.</p>
                            <ul class="course-features">
                                <li><i class="fas fa-check"></i>Técnicas de liderazgo moderno</li>
                                <li><i class="fas fa-check"></i>Gestión de conflictos</li>
                                <li><i class="fas fa-check"></i>Motivación de equipos</li>
                                <li><i class="fas fa-check"></i>Toma de decisiones estratégicas</li>
                            </ul>
                            <div class="course-footer">
                                <div class="course-price">
                                    <span class="price-label">Precio:</span>
                                    <span class="price-amount">$1,200</span>
                                </div>
                                <div class="course-actions">
                                    <a href="" class="btn btn-outline-primary custom-btn-outline">Ver
                                        Más</a>
                                    <a href=""
                                        class="btn btn-primary custom-btn-primary">Inscribirse</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
    
        <!-- Benefits Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h2 class="display-6 fw-bold text-primary-blue">¿Por qué Elegir Nuestros Cursos Ejecutivos?</h2>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="text-center">
                        <i class="fas fa-award fa-3x text-primary-orange mb-3"></i>
                        <h5 class="text-primary-blue">Certificación Reconocida</h5>
                        <p>Certificados avalados por instituciones de prestigio</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="text-center">
                        <i class="fas fa-user-graduate fa-3x text-primary-orange mb-3"></i>
                        <h5 class="text-primary-blue">Instructores Expertos</h5>
                        <p>Profesionales con amplia experiencia ejecutiva</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="text-center">
                        <i class="fas fa-network-wired fa-3x text-primary-orange mb-3"></i>
                        <h5 class="text-primary-blue">Networking</h5>
                        <p>Conecta con otros ejecutivos y líderes empresariales</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="text-center">
                        <i class="fas fa-rocket fa-3x text-primary-orange mb-3"></i>
                        <h5 class="text-primary-blue">Crecimiento Profesional</h5>
                        <p>Acelera tu carrera hacia posiciones de liderazgo</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-content text-center">
                <h2>Impulsa tu Carrera Ejecutiva</h2>
                <p>Únete a nuestra comunidad de líderes empresariales y transforma tu futuro profesional</p>
                <div class="cta-buttons">
                    <a href="" class="btn btn-primary custom-btn-primary">
                        <i class="fas fa-rocket me-2"></i>Inscribir Ahora
                    </a>
                    <a href="{{route('contacto')}}" class="btn btn-outline-light custom-btn-outline-light">
                        <i class="fas fa-phone me-2"></i>Más Información
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection
