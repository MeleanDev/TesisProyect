@extends('website.layouts.app')
@section('subtitulo', 'Preinscripciones')
@section('content')
    <x-page-header titulo="Preinscripciones"
        subtitulo="Completa el formulario para preinscribirte en nuestros cursos. Te contactaremos pronto."
        icono="fas fa-user-plus" :breadcrumb="[
            ['nombre' => 'Inicio', 'link' => 'index.html', 'activo' => false],
            ['nombre' => 'Preinscripciones', 'link' => null, 'activo' => true],
        ]" />

    <section class="py-5">
        <div class="container">
            <div class="section-header text-center">
                <span class="section-badge">Preinscripcion</span>
                <h2 class="section-title">¿Deseas inscribirte a uno de nuestros <span class="text-gradient">Cursos?</span>
                </h2>
                <p class="section-subtitle">Rellena el formulario. Y recibiremos tu preinscripcion a distancia.</p>
            </div>
            <div class="row g-5">
                <div class="col-lg-4">
                    <div class="card border-0 shadow h-100">
                        <div class="card-body p-4">
                            <h3 class="text-primary-blue mb-4">¿Por qué preinscribirte?</h3>
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-check-circle text-primary-orange me-3"></i>
                                <span>Reserva tu cupo antes que se agoten</span>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-check-circle text-primary-orange me-3"></i>
                                <span>Recibe información detallada del curso</span>
                            </div>
                            <div class="d-flex align-items-center mb-4">
                                <i class="fas fa-check-circle text-primary-orange me-3"></i>
                                <span>Asesoría personalizada</span>
                            </div>

                            <h4 class="text-primary-blue mb-3">Tipos de Cursos:</h4>
                            <div class="course-type mb-3">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-building text-primary-orange me-3"></i>
                                    <div>
                                        <h6 class="mb-1 text-primary-blue">Cursos para Empresas</h6>
                                        <small class="text-muted">Capacitación corporativa</small>
                                    </div>
                                </div>
                            </div>
                            <div class="course-type mb-3">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-child text-primary-orange me-3"></i>
                                    <div>
                                        <h6 class="mb-1 text-primary-blue">Cursos para Menores</h6>
                                        <small class="text-muted">Programas educativos</small>
                                    </div>
                                </div>
                            </div>
                            <div class="course-type">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-user-tie text-primary-orange me-3"></i>
                                    <div>
                                        <h6 class="mb-1 text-primary-blue">Cursos Ejecutivos</h6>
                                        <small class="text-muted">Formación profesional</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="card border-0 shadow">
                        <div class="card-body p-4">
                            <h2 class="text-primary-blue mb-4">Formulario de Preinscripción</h2>
                            <form id="preinscriptionForm">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="primerNombre" class="form-label">Primer Nombre *</label>
                                        <input type="text" class="form-control" id="primerNombre" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="segundoNombre" class="form-label">Segundo Nombre</label>
                                        <input type="text" class="form-control" id="segundoNombre">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="primerApellido" class="form-label">Primer Apellido *</label>
                                        <input type="text" class="form-control" id="primerApellido" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="segundoApellido" class="form-label">Segundo Apellido</label>
                                        <input type="text" class="form-control" id="segundoApellido">
                                    </div>
                                    <div class="col-12">
                                        <label for="cedulaRif" class="form-label">Cédula de Identidad / RIF *</label>
                                        <input type="text" class="form-control" id="cedulaRif" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="correo" class="form-label">Correo Electrónico *</label>
                                        <input type="email" class="form-control" id="correo" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="fechaNacimiento" class="form-label">Fecha de Nacimiento *</label>
                                        <input type="date" class="form-control" id="fechaNacimiento" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="telefono" class="form-label">Teléfono</label>
                                        <input type="tel" class="form-control" id="telefono">
                                    </div>
                                    <div class="col-12">
                                        <label for="tipoCurso" class="form-label">Tipo de Curso de Interés *</label>
                                        <div class="select2-responsive-container">
                                            <select class="form-select w-100" id="tipoCurso" required>
                                                <option value="">Selecciona un tipo de curso</option>
                                                <option value="empresas">Cursos para Empresas</option>
                                                <option value="menores">Cursos para Menores</option>
                                                <option value="ejecutivos">Cursos Ejecutivos</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12" id="div-curso-especifico" style="display: none;">
                                        <label for="cursoEspecifico" class="form-label">Curso de Interés *</label>
                                        <div class="select2-responsive-container">
                                            <select class="form-select w-100" id="cursoEspecifico" required>
                                                <option value="">Cargando cursos...</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label for="comentarios" class="form-label">Comentarios Adicionales</label>
                                        <textarea class="form-control" id="comentarios" rows="4"
                                            placeholder="Cuéntanos sobre tus expectativas o preguntas específicas..."></textarea>
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
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            const $tipoCursoSelect = $('#tipoCurso');
            const $divCursoEspecifico = $('#div-curso-especifico');
            const $cursoEspecificoSelect = $('#cursoEspecifico');

            // Solución: Añadir 'width: 100%' para que Select2 se ajuste
            $tipoCursoSelect.select2({
                placeholder: "Selecciona un tipo de curso",
                allowClear: true,
                width: '100%'
            });

            // Solución: Añadir 'width: 100%' y el dropdownParent
            $cursoEspecificoSelect.select2({
                placeholder: "Selecciona un curso",
                allowClear: true,
                dropdownParent: $divCursoEspecifico,
                width: '100%'
            });

            const cursosDisponibles = {
                'empresas': [{
                    id: 1,
                    text: 'Liderazgo y Gestión de Equipos'
                }, {
                    id: 2,
                    text: 'Innovación y Estrategia Empresarial'
                }, {
                    id: 3,
                    text: 'Finanzas para No Financieros'
                }],
                'menores': [{
                    id: 4,
                    text: 'Robótica y Programación Básica'
                }, {
                    id: 5,
                    text: 'Inglés para Niños'
                }, {
                    id: 6,
                    text: 'Pensamiento Lógico y Creativo'
                }],
                'ejecutivos': [{
                    id: 7,
                    text: 'Oratoria y Presentaciones de Impacto'
                }, {
                    id: 8,
                    text: 'Desarrollo de Habilidades Gerenciales'
                }, {
                    id: 9,
                    text: 'Negociación Estratégica'
                }]
            };

            $tipoCursoSelect.on('change', function() {
                const tipoSeleccionado = $(this).val();

                if (tipoSeleccionado) {
                    $divCursoEspecifico.show();

                    const cursos = cursosDisponibles[tipoSeleccionado] || [];
                    const newOptions = [{
                        id: '',
                        text: 'Selecciona un curso',
                        disabled: true,
                        selected: true
                    }].concat(cursos);

                    $cursoEspecificoSelect.empty().select2({
                        data: newOptions,
                        placeholder: "Selecciona un curso",
                        allowClear: true,
                        dropdownParent: $divCursoEspecifico,
                        width: '100%' // Asegura que el ancho sea correcto al cambiar
                    });
                } else {
                    $divCursoEspecifico.hide();
                    $cursoEspecificoSelect.val(null).trigger('change');
                }
            });

            const preinscriptionForm = document.getElementById('preinscriptionForm');
            preinscriptionForm.addEventListener('submit', function(event) {
                event.preventDefault();

                const formData = {
                    primerNombre: document.getElementById('primerNombre').value,
                    segundoNombre: document.getElementById('segundoNombre').value,
                    primerApellido: document.getElementById('primerApellido').value,
                    segundoApellido: document.getElementById('segundoApellido').value,
                    cedulaRif: document.getElementById('cedulaRif').value,
                    correo: document.getElementById('correo').value,
                    fechaNacimiento: document.getElementById('fechaNacimiento').value,
                    telefono: document.getElementById('telefono').value,
                    tipoCurso: $tipoCursoSelect.val(),
                    cursoEspecifico: $cursoEspecificoSelect.val(),
                    comentarios: document.getElementById('comentarios').value
                };

                try {
                    Swal.fire({
                        title: '¡Gracias! Preinscripción Enviada',
                        text: 'Tu solicitud de preinscripción ha sido enviada con éxito. Nos pondremos en contacto contigo pronto para los próximos pasos en tu correo en electronico "No olvides revisar tu bandeja de spawn".',
                        icon: 'success',
                        confirmButtonText: 'Cerrar',
                        customClass: {
                            confirmButton: 'btn btn-primary custom-btn-primary'
                        }
                    })
                } catch (error) {
                    Swal.fire({
                        title: '¡Error al Enviar!',
                        text: 'Hubo un problema al enviar tu preinscripción. Por favor, inténtalo de nuevo más tarde.',
                        icon: 'error',
                        confirmButtonText: 'Cerrar',
                        customClass: {
                            confirmButton: 'btn btn-primary custom-btn-primary'
                        }
                    })
                }

                preinscriptionForm.reset();

                $tipoCursoSelect.val(null).trigger('change');
                $divCursoEspecifico.hide();
                $cursoEspecificoSelect.empty().select2({
                    data: [{
                        id: '',
                        text: 'Cargando cursos...'
                    }],
                    width: '100%'
                });
            });
        });
    </script>
@endsection
