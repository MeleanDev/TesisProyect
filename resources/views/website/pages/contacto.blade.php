@extends('website.layouts.app')
@section('subtitulo', 'Contacto')
@section('descripcion', 'Estamos aquí para ayudarte. Contáctanos para más información sobre nuestros cursos.')
@section('keywords', 'contacto, información, cursos, ayuda, soporte, academia CADI, preguntas frecuentes')

@section('content')
    <x-page-header titulo="Contacto"
        subtitulo="Estamos aquí para ayudarte. Contáctanos para más información sobre nuestros cursos."
        icono="fas fa-envelope" :breadcrumb="[
            ['nombre' => 'Inicio', 'link' => 'index.html', 'activo' => false],
            ['nombre' => 'Contacto', 'link' => null, 'activo' => true],
        ]" />

    <section id="contacto-home" class="contact-section">
        <div class="container">
            <div class="section-header text-center">
                <span class="section-badge">Contáctanos</span>
                <h2 class="section-title">¿Tienes <span class="text-gradient">Preguntas?</span></h2>
                <p class="section-subtitle">Estamos aquí para ayudarte. Envíanos un mensaje y te responderemos pronto.</p>
            </div>

            <div class="row g-5">
                <div class="col-lg-6">
                    <div class="contact-info-card">
                        <h3>Información de Contacto</h3>
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="contact-details">
                                <h4>Dirección</h4>
                                <p>Av 55, casa # 97 38, <br>Maracaibo 4001, Zulia</p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="contact-details">
                                <h4>Teléfono</h4>
                                <p>+58 424-6526010</p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="contact-details">
                                <h4>Email</h4>
                                <p>info@academiaCadi.com</p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="contact-details">
                                <h4>Horarios</h4>
                                <p>Lunes a Viernes: 8:00 AM - 6:00 PM<br>Sábados: 9:00 AM - 2:00 PM</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="contact-form-card">
                        <h3>Envíanos un Mensaje</h3>
                        <form id="contactFormHome" class="contact-form">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre"
                                            required>
                                        <label for="nombre">Nombre *</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="apellido" id="apellido" placeholder="Apellido"
                                            required>
                                        <label for="apellido">Apellido *</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <input type="email" class="form-control" name="correo" id="correo"
                                            placeholder="Correo Electrónico" required>
                                        <label for="correo">Correo Electrónico *</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <input type="tel" class="form-control" name="telefono" id="telefono" placeholder="Teléfono">
                                        <label for="telefono">Teléfono</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <select class="form-control" name="asunto" id="asunto" required>
                                            <option value="">Selecciona un asunto</option>
                                            <option value="cursos-empresas">Cursos para Empresas</option>
                                            <option value="cursos-menores">Cursos para Menores</option>
                                            <option value="cursos-ejecutivos">Cursos Ejecutivos</option>
                                            <option value="informacion-general">Información General</option>
                                            <option value="otro">Otro</option>
                                        </select>
                                        <label for="asunto">Asunto *</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <textarea class="form-control" name="mensaje" id="mensaje" rows="4" placeholder="Tu mensaje" required maxlength="255"></textarea>
                                        <label for="mensaje">Mensaje *</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary custom-btn-primary w-100">
                                        <i class="fas fa-paper-plane me-2"></i>Enviar Mensaje
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('website.components.googlemaps')
@endsection

@section('scripts')
    <script>
        var token = $('meta[name="csrf-token"]').attr('content');
        const url = window.location.href;

        $('#contactFormHome').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: url,
                method: 'POST',
                data: formData,
                dataType: 'JSON',
                contentType: false,
                processData: false,
                cache: false,
                headers: {
                    'X-CSRF-TOKEN': token
                },
                success: function(data) {
                    if (data.success) {
                        Swal.fire({
                            icon: "success",
                            title: "Mensaje enviado",
                            text: "Tu mensaje fue enviado con éxito al administrador."
                        });
                        $('#contactFormHome')[0].reset(); 
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Tu mensaje no fue enviado",
                            text: "Tu mensaje no pudo ser enviado."
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: "error",
                        title: "Falla en el sistema",
                        text: "El mensaje no pudo ser enviado. Intente más tarde."
                    });
                }
            });
        });
    </script>
@endsection
