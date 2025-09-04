@extends('website.layouts.app')
@section('subtitulo', 'Cursos para Empresas')
@section('descripcion', 'Capacitación corporativa especializada para potenciar el talento de tu organización y mejorar la productividad empresarial.')
@section('keywords', 'cursos para empresas, capacitación corporativa, desarrollo profesional, formación empresarial, habilidades laborales, productividad empresarial')

@section('content')
    <x-page-header titulo="Para Menores Empresas"
        subtitulo="Capacitación corporativa especializada para potenciar el talento de tu organización y mejorar la productividad empresarial."
        icono="fas fa-building" :breadcrumb="[
            ['nombre' => 'Inicio', 'link' => 'index.html', 'activo' => false],
            ['nombre' => 'Cursos para Empresas', 'link' => null, 'activo' => true],
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
                                    <a href="{{route('preinscripcion')}}"
                                        class="btn btn-primary custom-btn-primary">Inscribirse</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-content text-center">
                <h2>¿Listo para Capacitar a tu Equipo?</h2>
                <p>Contáctanos para diseñar un programa de capacitación personalizado para tu empresa</p>
                <div class="cta-buttons">
                    <a href="{{route('preinscripcion')}}" class="btn btn-primary custom-btn-primary">
                        <i class="fas fa-rocket me-2"></i>Solicitar Cotización
                    </a>
                    <a href="{{route('contacto')}}" class="btn btn-outline-light custom-btn-outline-light">
                        <i class="fas fa-phone me-2"></i>Contactar Asesor
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection
