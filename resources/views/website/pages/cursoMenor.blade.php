@extends('website.layouts.app')
@section('subtitulo', 'Cursos Para Menores de Edad')
@section('descripcion',
    'Programas educativos diseñados para el desarrollo integral de niños y adolescentes en un
    entorno seguro y estimulante.')
@section('keywords',
    'cursos para menores, educación infantil, desarrollo integral, habilidades sociales, creatividad,
    aprendizaje seguro')
@section('content')
    <x-page-header titulo="Cursos Para Menores de Edad"
        subtitulo="Programas educativos diseñados para el desarrollo integral de niños y adolescentes en un entorno seguro y estimulante."
        icono="fas fa-child" :breadcrumb="[
            ['nombre' => 'Inicio', 'link' => 'index.html', 'activo' => false],
            ['nombre' => 'Cursos Para Menores de Edad', 'link' => null, 'activo' => true],
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
                                <img src="{{ $curso->image_url }}" height="250" width="400" alt="{{ $curso->nombre }}">
                                <div class="course-overlay">
                                    <a href="{{ route('cursoMenorDetalle', ['curso' => $curso->slug]) }}"
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
                                        <a href="{{ route('cursoMenorDetalle', ['curso' => $curso->slug]) }}"
                                            class="btn btn-outline-primary custom-btn-outline">Ver
                                            Más</a>
                                        <a href="{{route('preinscripcion')}}" class="btn btn-primary custom-btn-primary">Inscribirse</a>
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

    <!-- Benefits Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h2 class="display-6 fw-bold text-primary-blue">Beneficios de Nuestros Cursos</h2>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="text-center">
                        <i class="fas fa-brain fa-3x text-primary-orange mb-3"></i>
                        <h5 class="text-primary-blue">Desarrollo Cognitivo</h5>
                        <p>Estimulamos el pensamiento crítico y la resolución de problemas</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="text-center">
                        <i class="fas fa-heart fa-3x text-primary-orange mb-3"></i>
                        <h5 class="text-primary-blue">Inteligencia Emocional</h5>
                        <p>Fortalecemos la autoestima y las habilidades sociales</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="text-center">
                        <i class="fas fa-lightbulb fa-3x text-primary-orange mb-3"></i>
                        <h5 class="text-primary-blue">Creatividad</h5>
                        <p>Fomentamos la imaginación y el pensamiento innovador</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="text-center">
                        <i class="fas fa-trophy fa-3x text-primary-orange mb-3"></i>
                        <h5 class="text-primary-blue">Logros</h5>
                        <p>Celebramos cada avance y construimos confianza</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-content text-center">
                <h2>¿Listo para que tu Hijo Aprenda? </h2>
                <p>Inscribe a tu hijo en nuestros cursos y dale las herramientas para un futuro brillante</p>
                <div class="cta-buttons">
                    <a href="" class="btn btn-primary custom-btn-primary">
                        <i class="fas fa-rocket me-2"></i>Inscribir Ahora
                    </a>
                    <a href="{{ route('contacto') }}" class="btn btn-outline-light custom-btn-outline-light">
                        <i class="fas fa-phone me-2"></i>Más Información
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
