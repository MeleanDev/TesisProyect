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
    <x-page-header titulo="Preinscripción"
        subtitulo="Completa tu proceso de preinscripción para nuestros cursos"
        icono="fas fa-edit" :breadcrumb="[
            ['nombre' => 'Inicio', 'link' => 'index.html', 'activo' => false],
            ['nombre' => 'Preinscripción', 'link' => null, 'activo' => true],
        ]" />

    <section class="preinscripcion-section py-5">
        <div class="container">
            <div class="row justify-content-center">
                
                <!-- Payment Information Section -->
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <div class="card custom-card">
                        <div class="card-body p-5">
                            <h4 class="card-title text-center mb-4">Datos de Pago</h4>
                            <div class="mb-5">
                                <h5 class="mb-3">Transferencia Bancaria</h5>
                                <ul class="list-unstyled">
                                    <li class="mb-2"><strong>Banco:</strong> Banco de Venezuela</li>
                                    <li class="mb-2"><strong>Número de cuenta:</strong> 0123-4567-8901-2345</li>
                                    <li class="mb-2"><strong>Teléfono:</strong> +58 412 1234567</li>
                                    <li class="mb-2"><strong>Nombre del propietario:</strong> Academia CADI</li>
                                    <li class="mb-2"><strong>Correo electrónico:</strong> pago@academiaca.com</li>
                                </ul>
                            </div>
                            <div>
                                <h5 class="mb-3">Pago Móvil</h5>
                                <ul class="list-unstyled">
                                    <li class="mb-2"><strong>Banco:</strong> Banco de Venezuela</li>
                                    <li class="mb-2"><strong>Teléfono:</strong> +58 412 1234567</li>
                                    <li class="mb-2"><strong>Cédula de Identidad o Rif:</strong> J-12345678-9</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pre-registration Form Section -->
                <div class="col-lg-8">
                    <div class="card custom-card" id="verificacionCard">
                        <div class="card-body p-5">
                            <div class="text-center mb-5">
                                <h2 class="card-title">Verificación de Cliente</h2>
                                <p class="card-text">Ingresa tu cédula de identidad y/o Rif para verificar si ya eres cliente de nuestra institución</p>
                            </div>
                            
                            <form id="verificacionForm">
                                @csrf
                                <div class="form-group mb-4">
                                    <input type="text" class="form-control" name="identidad" id="identidad" 
                                        placeholder="Ejemplo: V12345678" required>
                                </div>
                                
                                <button type="submit" class="btn btn-primary custom-btn-primary w-100" id="verifyBtn">
                                    <span class="btn-text"><i class="fas fa-search me-2"></i>Verificar</span>
                                </button>
                            </form>
                        </div>
                    </div>

                    <div id="resultadoVerificacion" class="d-none">
                        <!-- Aquí se cargará el formulario de preinscripción -->
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
    $(document).ready(function() {
        // Manejar la verificación de identidad
        $('#verificacionForm').submit(function(e) {
            e.preventDefault();
            const identidad = $('#identidad').val();
            const $verifyBtn = $('#verifyBtn');

            // Mostrar estado de carga en el botón
            $verifyBtn.addClass('loading').prop('disabled', true);
            $('#resultadoVerificacion').addClass('d-none').empty();

            $.ajax({
                url: "{{ route('verificacionCliente') }}",
                method: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    identidad: identidad
                },
                success: function(response) {
                    // Ocultar la tarjeta de verificación después de la respuesta exitosa
                    $('#verificacionCard').hide();

                    if (response.existe) {
                        // Cliente existe - mostrar formulario simplificado
                        $('#resultadoVerificacion').html(`
                            <div class="card custom-card">
                                <div class="card-body p-5">
                                    <div class="alert alert-success mt-4">
                                        <i class="fas fa-check-circle me-2"></i>
                                        Cliente verificado: <strong>${response.cliente.Pnombre} ${response.cliente.Papelldio}</strong>
                                    </div>
                                    <form id="preinscripcionFormExistente" enctype="multipart/form-data">
                                        <input type="hidden" name="cliente_id" value="${response.cliente.id}">
                                        <input type="hidden" name="identidad" value="${identidad}">
                                        
                                        <h5 class="mt-4 mb-3">Continuar preinscripción</h5>
                                        
                                        <div class="form-group mb-3">
                                            <select class="form-control" name="curso_id" required>
                                                <option value="">Seleccione un curso</option>
                                                @foreach($cursos as $curso)
                                                    <option value="{{ $curso->slug }}">{{ $curso->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div id="cursoDetailsContainer" class="d-none"></div>
                                        
                                        <div class="form-group mb-4">
                                            <label class="form-label">Comprobante de pago *</label>
                                            <input type="file" class="form-control" name="comprobante" accept="image/*,.pdf" required>
                                            <div class="form-text">Formatos aceptados: JPG, PNG, PDF (Máx. 5MB)</div>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-primary w-100">
                                            <i class="fas fa-paper-plane me-2"></i>Enviar Preinscripción
                                        </button>
                                    </form>
                                </div>
                            </div>
                        `).removeClass('d-none');
                    } else {
                        $('#resultadoVerificacion').html(`
                            <div class="card custom-card">
                                <div class="card-body p-5">
                                    <div class="alert alert-info mt-4">
                                        <i class="fas fa-info-circle me-2"></i>
                                        No encontramos tu cédula. Por favor, completa el formulario completo para registrarte.
                                    </div>
                                    <form id="preinscripcionFormNuevo" enctype="multipart/form-data">
                                        <input type="hidden" name="identidad" value="${identidad}">
                                        
                                        <h5 class="mt-4 mb-3">Registrar nuevo cliente</h5>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="Pnombre" required>
                                                    <label>Primer Nombre *</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="Snombre">
                                                    <label>Segundo Nombre</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="Papelldio" required>
                                                    <label>Primer Apellido *</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="Sapelldio">
                                                    <label>Segundo Apellido</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <input type="email" class="form-control" name="email" required>
                                            <label>Correo electrónico *</label>
                                        </div>
                                        <div class="form-group mb-3">
                                            <input type="tel" class="form-control" name="telefono" required>
                                            <label>Telefono</label>
                                        </div>
                                        <div class="form-group mb-3">
                                            <input type="text" class="form-control" name="image">
                                        </div>
                                        <div class="form-group mb-3">
                                            <input type="date" class="form-control" name="fecha_nacimiento" required>
                                            <label>Fecha de nacimiento *</label>
                                        </div>
                                        <div class="form-group mb-3">
                                            <select class="form-control" name="curso_id" required>
                                                <option value="">Seleccione un curso</option>
                                                @foreach($cursos as $curso)
                                                    <option value="{{ $curso->slug }}">{{ $curso->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div id="cursoDetailsContainer" class="d-none"></div>

                                        <div class="form-group mb-4">
                                            <label class="form-label">Comprobante de pago *</label>
                                            <input type="file" class="form-control" name="comprobante" accept="image/*,.pdf" required>
                                            <div class="form-text">Formatos aceptados: JPG, PNG, PDF (Máx. 5MB)</div>
                                        </div>
                                        
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
                }
            });
        });
        
        // Manejar el cambio de curso y mostrar detalles
        $(document).on('change', '#preinscripcionFormExistente select, #preinscripcionFormNuevo select', function() {
            const cursoId = $(this).val();
            const $detailsContainer = $('#cursoDetailsContainer');
            const peticionCursoDatos = '{{route('detalleCurso')}}';
            
            if (cursoId) {
                $.ajax({
                    url: peticionCursoDatos+'/'+cursoId,
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

        // Delegación de eventos para los formularios dinámicos de envío
        $(document).on('submit', '#preinscripcionFormExistente, #preinscripcionFormNuevo', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const $submitBtn = $(this).find('button[type="submit"]');

            $submitBtn.addClass('loading').prop('disabled', true);

            $.ajax({
                url: "", // Asegúrate de que esta ruta exista
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
                            text: response.message || 'Ocurrió un error al procesar la preinscripción.'
                        });
                    }
                },
                error: function(xhr) {
                    $submitBtn.removeClass('loading').prop('disabled', false);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error al enviar',
                        text: 'Ocurrió un error al procesar la preinscripción. Intente nuevamente.'
                    });
                }
            });
        });
    });
</script>
@endsection