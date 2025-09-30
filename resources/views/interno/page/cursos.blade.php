@extends('interno.app.app')
@section('page', 'Gestion Cursos')
@section('tittle', 'Gestion Cursos')

@section('contenido')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 text-center">
                    <h3>Gestion Cursos</h3>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <button onclick="crear()" class="btn bg-gradient-primary btn-sm pb-2 ms-4">Añadir Curso</button>
                    <div class="container mt-4">
                        <table class="table align-items-center mb-0 display responsive nowrap" cellspacing="0" id="datatable"
                            style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Imagen</th>
                                    <th data-priority="1">Nombre</th>
                                    <th>Precio</th>
                                    <th>Horas</th>
                                    <th>Modalidad</th>
                                    <th>Certificación</th>
                                    <th data-priority="2" class="text-center">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Imagen</th>
                                    <th>Nombre</th>
                                    <th>Precio</th>
                                    <th>Horas</th>
                                    <th>Modalidad</th>
                                    <th>Certificación</th>
                                    <th class="text-center">Acción</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal --}}
    <div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="modalCRUD" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <form id="formulario">
                    @csrf
                    <div id="bg-titulo" class="modal-header">
                        <h5 class="modal-title" id="titulo"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <img id="preview" src="" width="150" height="150">
                        </div>
                        {{-- Foto --}}
                        <div class="form-group">
                            <label for="image" id="imageTitle">Foto del Curso || Solo formatos (JPG y PNG)</label>
                            <input type="file" id="image" name="image" class="form-control" accept=".jpg,.png"
                                onchange="previewImage()">
                            <small class="form-text" id="imagesmall">Foto del Curso (Obligatorio)</small>
                        </div>

                        {{-- Nombre y Slug --}}
                        <div class="row">
                            <div class="form-group text-center col-6">
                                <label for="nombre">Nombre del Curso</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" minlength="3"
                                    maxlength="100" placeholder="Nombre del Curso." required>
                                <small id="nombresmall" class="form-text">Nombre del Curso (Obligatorio)</small>
                            </div>
                            <div class="form-group text-center col-6">
                                <label for="slug">Slug del Curso</label>
                                <input type="text" class="form-control" id="slug" name="slug"
                                    placeholder="Slug del Curso." required>
                                <small id="slugsmall" class="form-text">Slug del Curso (Obligatorio)</small>
                            </div>
                        </div>

                        {{-- Descripción --}}
                        <div class="form-group text-center">
                            <label for="descripcion">Descripción del Curso.</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" minlength="1" placeholder="Descripción del Curso."
                                rows="3" required></textarea>
                            <small id="descripcionsmall" class="form-text">Descripción del Curso (Obligatorio)</small>
                        </div>

                        {{-- Precio y Horas Académicas --}}
                        <div class="row mb-4">
                            <div class="col-6">
                                <label for="precio" class="form-label">Precio del Curso</label>
                                <input type="number" class="form-control" id="precio" name="precio" required
                                    min="1" placeholder="Precio del curso." step="0.01">
                                <small id="preciosmall" class="form-text">Precio del Curso (Obligatorio)</small>
                            </div>
                            <div class="col-6">
                                <label for="horasAcademicas" class="form-label">Horas Académicas</label>
                                <input type="number" class="form-control" id="horasAcademicas" name="horasAcademicas"
                                    required min="1" placeholder="Horas del curso.">
                                <small id="horasAcademicassmall" class="form-text">Horas Académicas (Obligatorio)</small>
                            </div>
                        </div>

                        {{-- Máximo Participantes y Modalidad --}}
                        <div class="row mb-4">
                            <div class="col-6">
                                <label for="maximoParticipantes" class="form-label">Máximo de Participantes</label>
                                <input type="number" class="form-control" id="maximoParticipantes"
                                    name="maximoParticipantes" required min="1"
                                    placeholder="Máximo de participantes.">
                                <small id="maximoParticipantessmall" class="form-text">Máximo de Participantes
                                    (Obligatorio)</small>
                            </div>
                            <div class="form-group text-center col-6">
                                <label for="modalidad">Modalidad</label>
                                <select class="form-control mb-2" id="modalidad" name="modalidad" style="width: 100%"
                                    required>
                                    <option value="online">Online</option>
                                    <option value="presencial">Presencial</option>
                                    <option value="semi-presencial">Semi-presencial</option>
                                </select>
                                <small id="modalidadsmall" class="form-text">Modalidad del Curso (Obligatorio)</small>
                            </div>
                        </div>

                        {{-- Certificación, Tipo de Curso, y Categoría --}}
                        <div class="row mb-4">
                            <div class="form-group text-center col-4">
                                <label for="certificacion">Certificación</label>
                                <select class="form-control mb-2" id="certificacion" name="certificacion"
                                    style="width: 100%" required>
                                    <option value="si">Sí</option>
                                    <option value="no">No</option>
                                </select>
                                <small id="certificacionsmall" class="form-text">Certificación (Obligatorio)</small>
                            </div>
                            <div class="form-group text-center col-4">
                                <label for="tipoCurso">Tipo de Curso</label>
                                <select class="form-control mb-2" id="tipoCurso" name="tipoCurso" style="width: 100%"
                                    required>
                                    <option value="computacion">Computación</option>
                                    <option value="administracion">Administración</option>
                                    <option value="diseno">Diseño</option>
                                </select>
                                <small id="tipoCursosmall" class="form-text">Tipo de Curso (Obligatorio)</small>
                            </div>
                            <div class="form-group text-center col-4">
                                <label for="categoria">Categoría</label>
                                <select class="form-control mb-2" id="categoria" name="categoria" style="width: 100%"
                                    required>
                                    <option value="menores">Menores</option>
                                    <option value="ejecutivo">Ejecutivo</option>
                                    <option value="empresarial">Empresarial</option>
                                </select>
                                <small id="categoriasmall" class="form-text">Categoría del Curso (Obligatorio)</small>
                            </div>
                        </div>

                        {{-- Idioma --}}
                        <div class="form-group text-center">
                            <label for="idioma">Idioma</label>
                            <select class="form-control mb-2" id="idioma" name="idioma" style="width: 100%"
                                required>
                                <option value="spanish">Español</option>
                                <option value="english">Inglés</option>
                            </select>
                            <small id="idiomasmall" class="form-text">Idioma del Curso (Obligatorio)</small>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn bg-danger text-white"
                                data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" id="submit" class="btn bg-gradient-success">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        var token = $('meta[name="csrf-token"]').attr('content');
        var rutaAccion = "";
        var accion = 0;
        const urlCompleta = window.location.href;
        var cursoActual = {};

        $('#slug').on('input', function() {
            $(this).val($(this).val().replace(/\s+/g, '-').toLowerCase());
        });

        var table = new DataTable('#datatable', {
            ajax: urlCompleta + '/lista',
            responsive: true,
            processing: true,
            serverSide: true,
            lengthMenu: [
                [5, 10],
                [5, 10],
            ],
            columns: [{
                    data: 'image',
                    name: 'image',
                    className: 'text-center',
                    render: function(data, type, row) {
                        if (row.image) {
                            return '<img src="' + row.image + '" width="100" height="100">';
                        } else {
                            return '<span class="text-muted">Imagen no disponible</span>';
                        }
                    }
                },
                {
                    data: 'nombre',
                    name: 'nombre',
                    className: 'text-center',
                },
                {
                    data: 'precio',
                    name: 'precio',
                    className: 'text-center',
                },
                {
                    data: 'horasAcademicas',
                    name: 'horasAcademicas',
                    className: 'text-center',
                },
                {
                    data: 'modalidad',
                    name: 'modalidad',
                    className: 'text-center',
                },
                {
                    data: 'certificacion',
                    name: 'certificacion',
                    className: 'text-center',
                },
                {
                    "data": null,
                    "className": "align-middle text-center",
                    "render": function(data, type, row, meta) {
                        return `
                    <div class="dropdown">
                        <button class="btn btn-link text-secondary mb-0" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" data-bs-placement="right">
                            <i class="fa fa-ellipsis-v text-xs"></i>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" data-id="${row.id}" href="javascript:ver(${row.id});"><i class="fa fa-file text-primary"></i> Ver</a></li>
                            <li><a class="dropdown-item" data-id="${row.id}" href="javascript:editar(${row.id});"><i class="fa fa-edit text-warning"></i> Editar</a></li>
                            <li><a class="dropdown-item" data-id="${row.id}" href="javascript:eliminar(${row.id});"><i class="fa fa-trash text-danger"></i> Eliminar</a></li>
                        </ul>
                    </div>`;
                    },
                    "orderable": false
                },
            ],
            columnDefs: [{
                orderable: false,
                targets: [6, 0],
                responsivePriority: 1,
                responsivePriority: 2,
            }, ],
            language: {
                "zeroRecords": "Ningún resultado encontrado",
                "emptyTable": "No hay datos disponibles en esta tabla",
                "lengthMenu": "Mostrar _MENU_ registros",
                "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sSearch": "Buscar:",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "sProcessing": "Procesando...",
            },
        });

        // Consultas EndPoint
        consulta = function(id) {
            return new Promise((resolve, reject) => {
                $.ajax({
                    url: urlCompleta + "/detalle/" + id,
                    method: "GET",
                    success: function(Data) {
                        resolve(Data);
                    },
                    error: function(xhr, status, error) {
                        reject(error);
                    }
                });
            });
        };

        // Enviar datos
        $('#formulario').submit(function(e) {
            e.preventDefault(); // Previene la recarga de la página

            var formData = new FormData(this);

            $.ajax({
                url: rutaAccion,
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
                    table.ajax.reload(null, false);
                    if (data.success) {
                        if (accion === 1) {
                            notificacion.fire({
                                icon: "success",
                                title: "¡Información Guardada!",
                                text: "Registro guardado con éxito."
                            });
                        } else {
                            notificacion.fire({
                                icon: "success",
                                title: "¡Información Editada!",
                                text: "Registro editado con éxito."
                            });
                        }
                    } else {
                        notificacion.fire({
                            icon: "error",
                            title: "Registro no cargado.",
                            text: data.message
                        });
                    }
                },
                error: function(xhr, status, error) {
                    notificacion.fire({
                        title: "Fallo en el sistema",
                        text: "¡El registro no se ha añadido al sistema!",
                        icon: "error"
                    });
                }
            });

            $('#modalCRUD').modal('hide'); // Cierra el modal después de la solicitud AJAX
        });

        // Función para manejar el estado del formulario (ver/editar/crear)
        function configurarModal(modo, datos = {}) {
            const esVer = modo === 'ver';
            const esCrear = modo === 'crear';

            // Restablecer el formulario
            $("#formulario").trigger("reset");

            // Configurar el título y el color del modal
            let titulo, bgClass;
            if (esVer) {
                titulo = "Ver Curso -> " + datos.nombre;
                bgClass = "modal-header bg-info";
            } else if (modo === 'editar') {
                titulo = "Editar Curso -> " + datos.nombre;
                bgClass = "modal-header bg-warning";
            } else {
                titulo = "Añadir Cursos";
                bgClass = "modal-header bg-gradient-primary";
            }
            $("#titulo").html(titulo).attr("class", "modal-title text-white");
            $("#bg-titulo").attr("class", bgClass);

            // Ocultar/mostrar el botón de guardar
            $('#submit').toggle(!esVer);

            // Ocultar/mostrar el input de la imagen y sus etiquetas
            $('#image, #imageTitle, #imagesmall').toggle(!esVer);

            // Mostrar u ocultar la previsualización de la imagen
            const imagenSrc = datos.image ? datos.image : "{{ asset('assets/img/stock.png') }}";
            $('#preview').attr('src', imagenSrc);

            // Configurar los campos del formulario
            const campos = [
                'nombre', 'slug', 'descripcion', 'precio', 'horasAcademicas',
                'maximoParticipantes', 'modalidad', 'certificacion',
                'tipoCurso', 'categoria', 'idioma'
            ];

            campos.forEach(campo => {
                // Habilitar o deshabilitar los campos
                $(`#${campo}`).prop('disabled', esVer).prop('readonly', esVer);

                // Ocultar o mostrar los textos de ayuda
                $(`#${campo}small`).toggle(!esVer);

                // Llenar los campos con los datos
                if (datos[campo]) {
                    $(`#${campo}`).val(datos[campo]);
                }
            });

            // Forzar el estado de la imagen
            if (esCrear) {
                $('#image').prop('required', true);
            } else {
                $('#image').prop('required', false);
            }

            // Mostrar el modal
            $('#modalCRUD').modal('show');
        }

        // ACCIONES
        crear = function() {
            rutaAccion = urlCompleta;
            accion = 1;
            configurarModal('crear');
        };

        ver = async function(id) {
            try {
                cursoActual = await consulta(id);
                configurarModal('ver', cursoActual);
            } catch (error) {
                notificacion.fire({
                    icon: "error",
                    title: "¡ Eliminado !",
                    text: "Su registro no se puede visualizar."
                });
            }
        };

        editar = async function(id) {
            rutaAccion = urlCompleta + "/editar/" + id;
            accion = 2;
            try {
                cursoActual = await consulta(id);
                configurarModal('editar', cursoActual);
            } catch (error) {
                notificacion.fire({
                    icon: "error",
                    title: "¡ Eliminado !",
                    text: "Su registro no se puede visualizar."
                });
            }
        };

        eliminar = function(id) {
            Swal.fire({
                title: '¿Está seguro de que desea eliminar el registro?',
                text: "¡No podrá revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, ¡eliminar!',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: urlCompleta + "/" + id,
                        method: "DELETE",
                        headers: {
                            'X-CSRF-TOKEN': token
                        },
                        success: function(data) {
                            if (data.success) {
                                table.row('#' + id).remove().draw();
                                notificacion.fire({
                                    icon: "success",
                                    title: "¡ Eliminado !",
                                    text: "Su registro ha sido eliminado."
                                });
                            } else {
                                notificacion.fire({
                                    icon: "error",
                                    title: "¡ Error !",
                                    text: "Su registro no se pudo eliminar."
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                title: "Error en el sistema",
                                text: "¡El registro no se ha podido eliminar!",
                                icon: "error"
                            });
                        }
                    });
                }
            });
        };

        function previewImage() {
            const file = document.getElementById('image').files[0];
            const preview = document.getElementById('preview');
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            } else {
                preview.src = "{{ asset('assets/img/stock.png') }}";
            }
        }
    </script>
@endsection
