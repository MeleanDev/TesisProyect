@extends('website.layouts.app')
@switch($curso->categoria)
    @case('empresarial')
        @section('subtitulo', '')
    @break

    @case('ejecutivo')
        @section('subtitulo', '')
    @break

    @case('menores')
        @section('subtitulo', '')
    @break
@endswitch
@section('descripcion', '')
@section('keywords', '')

@section('content')
    <section class="course-hero-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Inicio</a></li>
                            @switch($curso->categoria)
                                @case('empresarial')
                                    <li class="breadcrumb-item"><a href="{{ route('cursoEmpresa') }}">Cursos para Empresas</a></li>
                                @break

                                @case('ejecutivo')
                                    <li class="breadcrumb-item"><a href="{{ route('cursoEjecutivo') }}">Cursos para Ejecutivo</a>
                                    </li>
                                @break

                                @case('menores')
                                    <li class="breadcrumb-item"><a href="{{ route('cursoMenor') }}">Cursos para Menores</a></li>
                                @break
                            @endswitch
                            <li class="breadcrumb-item active">{{ $curso->nombre }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="course-hero-content">
                        <div class="course-category-badge">
                            <i class="fas fa-users-cog"></i>
                            @switch($curso->categoria)
                                @case('empresarial')
                                    <span>Curso para Empresas</span>
                                @break

                                @case('ejecutivo')
                                    <span>Curso para Ejecutivo</span>
                                @break

                                @case('menores')
                                    <span>Curso para Menores</span>
                                @break
                            @endswitch
                        </div>
                        <h1 class="course-hero-title text-white">{{ $curso->nombre }}</h1>
                        <p class="course-hero-description">{{ $curso->descripcion }}</p>

                        <div class="course-hero-meta">
                            <div class="meta-item">
                                <i class="fas fa-clock"></i>
                                <span>{{ $curso->horasAcademicas }} horas académicas</span>
                            </div>
                            <div class="meta-item">
                                <i class="fas fa-users"></i>
                                <span>Máximo {{ $curso->maximoParticipantes }} participantes</span>
                            </div>
                            <div class="meta-item">
                                <i class="fas fa-calendar"></i>
                                <span>Modalidad {{ $curso->modalidad }}</span>
                            </div>
                            @if ($curso->certificacion == 'si')
                                <div class="meta-item">
                                    <i class="fas fa-certificate"></i>
                                    <span>Certificación incluida</span>
                                </div>
                            @endif
                        </div>

                        <div class="course-hero-actions">
                            <a href="preinscripciones.html" class="btn btn-primary custom-btn-primary btn-lg">
                                <i class="fas fa-rocket me-2"></i>Inscribirse Ahora
                            </a>
                            <button class="btn btn-outline-light custom-btn-outline-light btn-lg" data-bs-toggle="modal"
                                data-bs-target="#contactModal">
                                <i class="fas fa-phone me-2"></i>Solicitar Información
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="course-hero-image">
                        <img src="{{ $curso->image }}" height="400" width="500" alt="{{ $curso->nombre }}"
                            class="img-fluid">
                        <div class="course-price-card">
                            <div class="price-badge">
                                <span class="price-label">Precio del Curso</span>
                                <span class="price-amount">${{ $curso->precio }}</span>
                            </div>
                            <div class="price-features">
                                @if ($curso->certificacion == 'si')
                                    <div class="feature">
                                        <i class="fas fa-check"></i>
                                        <span>Certificado oficial</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="course-details-section">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-8">
                    <!-- Course Overview -->
                    <div class="course-section">
                        <h2 class="section-title">Descripción del <span class="text-gradient">Curso</span></h2>
                        <p class="section-description">{{ $curso->descripcion }}.</p>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <div class="course-sidebar">
                        <!-- Course Info Card -->
                        <div class="sidebar-card">
                            <h3>Información del Curso</h3>
                            <div class="course-info-list">
                                <div class="info-item">
                                    <i class="fas fa-clock"></i>
                                    <div class="info-content">
                                        <span class="info-label">Duración</span>
                                        <span class="info-value">{{ $curso->horasAcademicas }} horas académicas</span>
                                    </div>
                                </div>
                                <div class="info-item">
                                    <i class="fas fa-calendar"></i>
                                    <div class="info-content">
                                        <span class="info-label">Modalidad</span>
                                        <span class="info-value">{{ $curso->modalidad }}</span>
                                    </div>
                                </div>
                                <div class="info-item">
                                    <i class="fas fa-users"></i>
                                    <div class="info-content">
                                        <span class="info-label">Participantes</span>
                                        <span class="info-value">Máximo {{ $curso->maximoParticipantes }}</span>
                                    </div>
                                </div>
                                <div class="info-item">
                                    <i class="fas fa-language"></i>
                                    <div class="info-content">
                                        <span class="info-label">Idioma</span>
                                        <span class="info-value">{{ $curso->idioma }}</span>
                                    </div>
                                </div>
                                @if ($curso->certificacion == 'si')
                                    <div class="info-item">
                                        <i class="fas fa-certificate"></i>
                                        <div class="info-content">
                                            <span class="info-label">Certificación</span>
                                            <span class="info-value">Incluida</span>
                                        </div>
                                    </div>
                                @endif
                                <div class="info-item">
                                    <i class="fas fa-dollar-sign"></i>
                                    <div class="info-content">
                                        <span class="info-label">Precio</span>
                                        <span class="info-value price">${{ $curso->precio }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="sidebar-actions">
                                <a href="preinscripciones.html" class="btn btn-primary custom-btn-primary w-100 mb-3">
                                    <i class="fas fa-rocket me-2"></i>Inscribirse Ahora
                                </a>
                                <button class="btn btn-outline-primary custom-btn-outline w-100" data-bs-toggle="modal"
                                    data-bs-target="#contactModal">
                                    <i class="fas fa-phone me-2"></i>Solicitar Información
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
