@extends('website.layouts.app')
@section('subtitulo', 'Preinscripción')
@section('descripcion', 'Completa tu proceso de preinscripción en Academia CADI')
@section('keywords', 'preinscripción, cursos, academia, formulario')

@section('styles')
    <style>
        .custom-card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
            background-color: #ffffff;
        }

        .form-group label {
            color: #6c757d;
            font-weight: 500;
        }

        .form-text {
            font-size: 0.8em;
            color: #999;
        }

        .btn.loading {
            position: relative;
            color: transparent !important;
        }

        .btn.loading .spinner-border {
            display: block !important;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
        }

        .spinner-border {
            display: none;
        }

        .curso-details-card {
            background-color: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 0.5rem;
            padding: 1.5rem;
            margin-top: 1.5rem;
        }

        .curso-details-card img {
            border-radius: 0.5rem;
            object-fit: cover;
        }
    </style>
@endsection

@section('content')
    <x-page-header titulo="Preinscripción" subtitulo="Completa tu proceso de preinscripción para nuestros cursos"
        icono="fas fa-edit" :breadcrumb="[
            ['nombre' => 'Inicio', 'link' => 'index.html', 'activo' => false],
            ['nombre' => 'Preinscripción', 'link' => null, 'activo' => true],
        ]" />

    <section class="preinscripcion-section py-5">
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-lg-4 mb-4 mb-lg-0">
                    <div class="card custom-card">
                        <div class="card-body p-5">
                            <h4 class="card-title text-center mb-4">Proceso de Preinscripción</h4>
                            <div class="mb-5">
                                <h5 class="mb-3">¡Informacion!</h5>
                                <p class="fw-bold text-danger">⚠️ Deberás estar atento a tu correo electrónico, ya que te
                                    enviaremos una notificación cuando termines tu proceso de preinscripcion con el estado
                                    de tu preinscripción y los próximos pasos.</p>
                            </div>

                            <hr>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="card custom-card" id="verificacionCard">
                        <div class="card-body p-5">
                            <div class="text-center mb-5">
                                <h2 class="card-title">Verificación de Cliente</h2>
                                <p class="card-text">Ingresa tu cédula de identidad y/o Rif para verificar si ya eres
                                    cliente de nuestra institución</p>
                            </div>

                            <form id="verificacionForm">
                                @csrf
                                <div class="input-group mb-4">
                                    <span class="input-group-text p-0 border-0 bg-transparent">
                                        <select class="form-select border-1" id="prefixSelect" name="identidad_prefix"
                                            style="width: auto;">
                                            <option value="V" selected>V</option>
                                            <option value="E">E</option>
                                            <option value="J">J</option>
                                            <option value="G">G</option>
                                            <option value="P">P</option>
                                            <option value="C">C</option>
                                        </select>
                                    </span>
                                    <input type="text" class="form-control" name="identidad_number" id="identidad"
                                        placeholder="12345678" required
                                        oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.slice(0,this.maxLength)"
                                        maxlength="15" inputmode="numeric">
                                </div>
                                <input type="hidden" name="identidad" id="fullIdentidad">

                                <button type="submit" class="btn btn-primary custom-btn-primary w-100" id="verifyBtn">
                                    <span class="btn-text"><i class="fas fa-search me-2"></i>Verificar</span>
                                </button>
                            </form>
                        </div>
                    </div>

                    <div id="resultadoVerificacion" class="d-none">
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function calculateDateLimit(yearsAgo) {
            const today = new Date();
            // Clona la fecha de hoy y réstale los años requeridos
            const limitDate = new Date(today.getFullYear() - yearsAgo, today.getMonth(), today.getDate());
            
            // Formatea la fecha como YYYY-MM-DD (necesario para input type="date")
            const year = limitDate.getFullYear();
            const month = String(limitDate.getMonth() + 1).padStart(2, '0');
            const day = String(limitDate.getDate()).padStart(2, '0');
            
            return `${year}-${month}-${day}`;
        }

        const maxDateString = calculateDateLimit(10); 
        const minDateString = calculateDateLimit(80); 
        $(document).ready(function() {
            // Referencias a los elementos del DOM
            const prefixSelect = $('#prefixSelect');
            const identidadInput = $('#identidad');
            const fullIdentidadInput = $('#fullIdentidad');

            // 1. Lógica para actualizar el campo oculto
            function updateFullIdentidad() {
                const prefix = prefixSelect.val();
                const number = identidadInput.val();
                fullIdentidadInput.val(prefix + number);
            }

            // A. Agregar listeners para actualizar el campo cuando los valores cambien
            prefixSelect.on('change', updateFullIdentidad);
            identidadInput.on('input', updateFullIdentidad);
            
            // B. Actualizar el valor inicial al cargar la página
            updateFullIdentidad();

            // 2. Manejar la verificación de identidad
            $('#verificacionForm').submit(function(e) {
                e.preventDefault();
                updateFullIdentidad();

                const identidadCompleta = fullIdentidadInput.val(); 
                const $verifyBtn = $('#verifyBtn');

                $verifyBtn.addClass('loading').prop('disabled', true);
                $('#resultadoVerificacion').addClass('d-none').empty();

                $.ajax({
                    url: "{{ route('verificacionCliente') }}",
                    method: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        identidad: identidadCompleta 
                    },
                    success: function(response) {
                        $('#verificacionCard').hide();

                        if (response.existe) {
                            // Cliente EXISTE (Formulario de curso solamente)
                            $('#resultadoVerificacion').html(`
                                <div class="card custom-card">
                                    <div class="card-body p-5">
                                        <div class="alert alert-success mt-4">
                                            <i class="fas fa-check-circle me-2"></i>
                                            Cliente verificado: <strong>${response.cliente.Pnombre} ${response.cliente.Papelldio}</strong>
                                        </div>
                                        <form id="preinscripcionFormExistente" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="cliente_id" value="${response.cliente.id}">
                                            <input type="hidden" name="identidad" value="${identidadCompleta}">
                                            
                                            <h5 class="mt-4 mb-3">Continuar preinscripción</h5>
                                            
                                            <div class="form-group mb-3">
                                                <select class="form-control" name="curso_id" required>
                                                    <option value="">Seleccione un curso</option>
                                                    @foreach ($cursos as $curso)
                                                        <option value="{{ $curso->slug }}">{{ $curso->nombre }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div id="cursoDetailsContainer" class="d-none"></div>
                                            
                                            <button type="submit" class="btn btn-primary w-100">
                                                <i class="fas fa-paper-plane me-2"></i>Enviar Preinscripción
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            `).removeClass('d-none');
                        } else {
                            // Cliente NO EXISTE (Formulario de registro completo)
                            $('#resultadoVerificacion').html(`
                                <div class="card custom-card">
                                    <div class="card-body p-5">
                                        <div class="alert alert-info mt-4">
                                            <i class="fas fa-info-circle me-2"></i>
                                            No encontramos tu cédula. Por favor, completa el formulario completo para registrarte.
                                        </div>
                                        <form id="preinscripcionFormNuevo" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="identidad" value="${identidadCompleta}">
                                            
                                            <h5 class="mt-4 mb-3">Registrar nuevo cliente</h5>

                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control solo-letras" name="Pnombre" required>
                                                        <label>Primer Nombre *</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control solo-letras" name="Snombre">
                                                        <label>Segundo Nombre</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control solo-letras" name="Papelldio" required>
                                                        <label>Primer Apellido *</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control solo-letras" name="Sapelldio">
                                                        <label>Segundo Apellido</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group mb-3">
                                                <input type="email" class="form-control" name="email" required>
                                                <label>Correo electrónico *</label>
                                            </div>
                                            <div class="form-group mb-3">
                                                <input type="tel" class="form-control solo-numeros" name="telefono" required maxlength="15">
                                                <label>Telefono</label>
                                            </div>
                                            <div class="form-group mb-3">
                                                <input type="file" class="form-control" name="image" id="image" accept="image/*" required>
                                                <label for="image">Foto de Perfil del estudiante Y/O empresa *</label>
                                                <small class="form-text text-muted">Archivos permitidos: JPG, JPEG, PNG. Tamaño máximo: 5MB.</small>
                                            </div>
                                            
                                            <div class="form-group mb-3">
                                                <input type="date" class="form-control" name="fecha_nacimiento" required 
                                                       max="${maxDateString}" 
                                                       min="${minDateString}">
                                                <label>Fecha de nacimiento *</label>
                                                <small class="form-text text-muted">Edad permitida: Mínimo 10 años y Máximo 80 años.</small>
                                            </div>
                                            
                                            <div class="form-group mb-3">
                                                <select class="form-control" name="curso_id" required>
                                                    <option value="">Seleccione un curso</option>
                                                    @foreach ($cursos as $curso)
                                                    <option value="{{ $curso->slug }}">{{ $curso->nombre }}</option>
                                                    @endforeach
                                                </select>
                                                <label>Curso *</label>
                                            </div>
                                            <div id="cursoDetailsContainer" class="d-none"></div>
                                            
                                            <button type="submit" class="btn btn-primary w-100">
                                                <i class="fas fa-paper-plane me-2"></i>Enviar Preinscripción
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            `).removeClass('d-none');
                        }
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error de conexión',
                            text: 'No se pudo conectar con el servidor. Por favor, inténtelo de nuevo más tarde.',
                            confirmButtonText: 'Entendido'
                        });
                    },
                    complete: function() {
                        $verifyBtn.removeClass('loading').prop('disabled', false);
                    }
                });
            });

            // 3. Manejar el cambio de curso y mostrar detalles
            $(document).on('change',
                '#preinscripcionFormExistente select[name="curso_id"], #preinscripcionFormNuevo select[name="curso_id"]',
                function() {
                    const cursoSlug = $(this).val();
                    const $detailsContainer = $('#cursoDetailsContainer');
                    const peticionCursoDatos = '{{ route('detalleCurso', ['slug' => 'SLUG']) }}';

                    if (cursoSlug) {
                        const url = peticionCursoDatos.replace('SLUG', cursoSlug);
                        $.ajax({
                            url: url,
                            method: 'GET',
                            success: function(response) {
                                const curso = response.curso;
                                $detailsContainer.html(`
                                    <div class="curso-details-card mb-4 d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <img src="${curso.image}" alt="Imagen del curso" class="img-fluid" style="width: 120px; height: 90px;">
                                        </div>
                                        <div class="ms-4">
                                            <h5 class="mb-1">${curso.nombre}</h5>
                                            <p class="mb-1"><strong>Precio:</strong> $${curso.precio}</p>
                                            <p class="mb-1"><strong>Duración:</strong> ${curso.horasAcademicas} Horas</p>
                                            <p class="mb-0"><strong>Idioma:</strong> ${curso.idioma}</p>
                                        </div>
                                    </div>
                                `).removeClass('d-none');
                            },
                            error: function(xhr) {
                                $detailsContainer.html(`
                                    <div class="alert alert-danger mt-4">
                                        Error al cargar los detalles del curso.
                                    </div>
                                `).removeClass('d-none');
                            }
                        });
                    } else {
                        $detailsContainer.addClass('d-none').empty();
                    }
                });
                
            // 4. Manejar el envío de ambos formularios de preinscripción
            $(document).on('submit', '#preinscripcionFormExistente, #preinscripcionFormNuevo', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                const $submitBtn = $(this).find('button[type="submit"]');

                $submitBtn.addClass('loading').prop('disabled', true);

                $.ajax({
                    url: "{{ route('guardarPreinscripcion') }}",
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        $submitBtn.removeClass('loading').prop('disabled', false);
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: '¡Preinscripción exitosa!',
                                html: `Tu preinscripción ha sido registrada correctamente. <br>
                                    <strong>Número de referencia:</strong> ${response.referencia}<br>
                                    Estatus: <span class="badge bg-warning">Pendiente de verificación</span>`,
                                confirmButtonText: 'Entendido'
                            }).then(() => {
                                window.location.href = "{{ route('inicio') }}";
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.message ||
                                    'Ocurrió un error al procesar la preinscripción.'
                            });
                        }
                    },
                    error: function(xhr) {
                        $submitBtn.removeClass('loading').prop('disabled', false);
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            let errorMessage = 'Por favor, corrige los siguientes errores:<br>';
                            for (let field in errors) {
                                errorMessage += `- ${errors[field][0]}<br>`;
                            }
                            Swal.fire({
                                icon: 'error',
                                title: 'Error de validación',
                                html: errorMessage
                            });
                        } else if (xhr.status === 409) {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Preinscripción duplicada',
                                text: xhr.responseJSON.message ||
                                    'Ya te has preinscrito en este curso.'
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error al enviar',
                                text: 'Ocurrió un error al procesar la preinscripción. Intenta nuevamente.'
                            });
                        }
                    }
                });
            });

            // 5. Validar solo letras (Nombres/Apellidos)
            $(document).on('input', '.solo-letras', function() {
                // Permite letras (a-z, A-Z), acentos, ñ, y espacios
                this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g, '');
            });

            // 6. Validar solo números (Teléfono)
            $(document).on('input', '.solo-numeros', function() {
                // Permite solo dígitos (0-9)
                this.value = this.value.replace(/[^0-9]/g, '');
            });

        });
    </script>
@endsection