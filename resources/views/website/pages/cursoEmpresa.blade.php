@extends('website.layouts.app')
@section('subtitulo', 'Cursos para Empresas')
@section('descripcion',
    'Capacitación corporativa especializada para potenciar el talento de tu organización y mejorar
    la productividad empresarial.')
@section('keywords',
    'cursos para empresas, capacitación corporativa, desarrollo profesional, formación empresarial,
    habilidades laborales, productividad empresarial')

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
                @foreach ($cursos as $curso)
                    <div class="col-lg-6">
                        <div class="course-card">
                            <div class="course-image">
                                <img src="yo.png" height="250" width="400" alt="{{ $curso->nombre }}">
                                <div class="course-overlay">
                                    <a href="{{ route('cursoEmpresaDetalle', ['curso' => $curso->slug]) }}"
                                        class="btn btn-primary custom-btn-primary">
                                        <i class="fas fa-eye me-2"></i>Ver Detalles
                                    </a>
                                </div>
                            </div>
                            <div class="course-content">
                                <div class="course-meta">
                                    <span class="course-category">
                                        <i class="fas fa-users-cog"></i>{{ $curso->nombre }}
                                    </span>
                                    <span class="course-duration">
                                        <i class="fas fa-clock"></i>{{ $curso->horasAcademicas }} horas
                                    </span>
                                    <span class="course-duration">
                                        <i class="fas fa-clock"></i>Idioma: {{ $curso->idioma }}
                                    </span>
                                </div>
                                <h3 class="course-title">
                                    <a href="curso-detalle.html">{{ $curso->nombre }}</a>
                                </h3>
                                <p class="course-description">{{ $curso->descripcion }}</p>
                                <div class="course-footer">
                                    <div class="course-price">
                                        <span class="price-label">Precio:</span>
                                        <span class="price-amount">${{ $curso->precio }}</span>
                                    </div>
                                    <div class="course-actions">
                                        <a href="{{ route('cursoEmpresaDetalle', ['curso' => $curso->slug]) }}"
                                            class="btn btn-outline-primary custom-btn-outline">Ver
                                            Más</a>
                                        <a href="" class="btn btn-primary custom-btn-primary">Inscribirse</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{ $cursos->links() }}
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
                    <a href="{{ route('contacto') }}" class="btn btn-primary custom-btn-primary">
                        <i class="fas fa-rocket me-2"></i>Solicitar Cotización
                    </a>
                    <a href="{{ route('contacto') }}" class="btn btn-outline-light custom-btn-outline-light">
                        <i class="fas fa-phone me-2"></i>Contactar Asesor
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection
