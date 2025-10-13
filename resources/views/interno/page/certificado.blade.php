@extends('interno.app.app')
@section('page', 'Gestion Certificaciones')
@section('tittle', 'Gestion Certificaciones')

@section('contenido')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 text-center">
                    <h3>Gestion Certificaciones</h3>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <button onclick="crear()" class="btn bg-gradient-primary btn-sm pb-2 ms-4">
                        Agregar Certificaciones
                    </button>

                    <div class="container mt-4">

                        <div class="row border rounded p-3 mb-4 align-items-end">
                            <div class="col-md-4">
                                <label for="filtro_curso">Filtrar por Curso</label>
                                <select id="filtro_curso" class="form-select form-select-sm">
                                    <option value="">Todos los cursos</option>
                                    @foreach ($cursos as $curso)
                                        <option value="{{ $curso->id }}">{{ $curso->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="filtro_fecha_desde">Emitido Desde</label>
                                <input type="date" id="filtro_fecha_desde" class="form-control form-control-sm">
                            </div>
                            <div class="col-md-3">
                                <label for="filtro_fecha_hasta">Emitido Hasta</label>
                                <input type="date" id="filtro_fecha_hasta" class="form-control form-control-sm">
                            </div>
                            <div class="col-md-2">
                                <button id="btn_limpiar_filtros" class="btn btn-info btn-sm w-100">
                                    <i class="fas fa-eraser"></i> Limpiar Filtros
                                </button>
                            </div>
                        </div>

                        <table class="table align-items-center mb-0 display responsive nowrap" cellspacing="0"
                            id="datatable" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Cliente</th>
                                    <th>Curso</th>
                                    <th>Codigo</th>
                                    <th class="text-center" data-priority="2">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Cliente</th>
                                    <th>Curso</th>
                                    <th>Codigo</th>
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
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="estudiante_id" class="form-control-label">Estudiante</label>
                                    <select class="form-control" id="estudiante_id" name="estudiante_id" required>
                                        <option value="">Seleccione un estudiante</option>
                                        @foreach ($cliente as $item)
                                            <option value="{{ $item->id }}">{{ $item->identidad }}</option>
                                        @endforeach
                                    </select>
                                    <small class="form-text">Estudiante (Obligatorio)</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="curso_id" class="form-control-label">Curso</label>
                                    <select disabled class="form-control" id="curso_id" name="curso_id" required>
                                        <option value="">Seleccione un curso</option>
                                    </select>
                                    <small class="form-text">Curso (Obligatorio)</small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pdf_certificado" class="form-control-label">PDF del Certificado</label>
                                    <input type="file" class="form-control" id="pdf_certificado" name="pdf_certificado"
                                        placeholder="Ruta al archivo del certificado" accept=".pdf" required>
                                    <small class="form-text">PDF del Certificado (Obligatorio)</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="codigo_certificado" class="form-control-label">Código del
                                        Certificado</label>
                                    <input type="text" class="form-control" id="codigo_certificado"
                                        name="codigo_certificado" placeholder="Código único del certificado" required>
                                    <small class="form-text">Código del Certificado (Obligatorio)</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-danger text-white" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" id="submit" class="btn bg-gradient-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        var token = $('meta[name="csrf-token"]').attr('content');
        var rotaAcao = "";
        const urlCompleta = window.location.href;

        var table = new DataTable('#datatable', {
            ajax: {
                url: urlCompleta + '/lista',
                data: function(d) {
                    d.curso_id = $('#filtro_curso').val();
                    d.fecha_desde = $('#filtro_fecha_desde').val();
                    d.fecha_hasta = $('#filtro_fecha_hasta').val();
                }
            },
            responsive: true,
            processing: true,
            serverSide: true,
            lengthMenu: [
                [5, 10],
                [5, 10],
            ],
            columns: [{
                    data: 'cliente_identidad',
                    name: 'cliente_registrados.identidad', // El 'name' apunta a la columna real para ordenar/buscar
                    className: 'text-center',
                },
                {
                    data: 'curso_nombre', // Debe coincidir con el alias del controlador
                    name: 'cursos.nombre',
                    className: 'text-center',
                },
                {
                    data: 'codigo',
                    name: 'codigo',
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
                                <li><a class="dropdown-item" data-id="${row.id}" href="javascript:ver(${row.id});"><i class="fa fa-search text-info"></i> Ver Certificado</a></li>
                                <li><a class="dropdown-item" data-id="${row.id}" href="javascript:eliminar(${row.id});"><i class="fa fa-trash text-danger"></i> Eliminar</a></li>
                            </ul>
                        </div>`;
                    },
                    "orderable": false
                },
            ],
            columnDefs: [{
                orderable: false,
                targets: [3],
                responsivePriority: 1,
                responsivePriority: 2,

            }],
            language: {
                "zeroRecords": "Ningún resultado encontrado",
                "emptyTable": "Ningún dato disponible en esta tabla",
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

        $('#filtro_curso, #filtro_fecha_desde, #filtro_fecha_hasta').on('change', function() {
            table.ajax.reload();
        });

        // 2. Lógica del botón para limpiar los filtros
        $('#btn_limpiar_filtros').on('click', function() {
            $('#filtro_curso').val('');
            $('#filtro_fecha_desde').val('');
            $('#filtro_fecha_hasta').val('');
            table.ajax.reload();
        });

        // 3. Validación de Fechas
        $('#filtro_fecha_desde').on('change', function() {
            $('#filtro_fecha_hasta').attr('min', $(this).val());
        });

        $('#filtro_fecha_hasta').on('change', function() {
            const fechaDesde = $('#filtro_fecha_desde').val();
            const fechaHasta = $(this).val();
            if (fechaDesde && fechaHasta && fechaHasta < fechaDesde) {
                alert('La fecha "Hasta" no puede ser anterior a la fecha "Desde". Se corregirá automáticamente.');
                $(this).val(fechaDesde);
            }
        });

        //  Consultas EndPoint
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
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: rotaAcao,
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
                        notificacion.fire({
                            icon: "success",
                            title: "¡Información guardada!",
                            text: "Registro guardado con éxito."
                        });
                    } else {
                        notificacion.fire({
                            icon: "error",
                            title: "Registro no cargado.",
                            text: data.msj ||
                                "Ocurrió un error al guardar el registro."
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        title: "Fallo en el sistema",
                        text: "¡El registro no se agregó al sistema!",
                        icon: "error"
                    });
                }
            });

            $('#modalCRUD').modal('hide');
        });

        // ACCIONES
        crear = function() {
            rotaAcao = urlCompleta;
            $("#formulario").trigger("reset");

            // Editar Modal
            $("#titulo").html("Asignar Certificado");
            $("#titulo").attr("class", "modal-title text-white");
            $("#bg-titulo").attr("class", "modal-header bg-gradient-primary");

            $("#curso_id").attr("readonly", false);
            $("#pdf_certificado").attr("readonly", false);
            $("#codigo_certificado").attr("readonly", false);
            $("#estudiante_id").attr("readonly", false);

            $('#submit').show()
            $('#modalCRUD').modal('show');
        };

        ver = async function(id) {
            try {
                // Modificado para llamar a la nueva ruta /verCertificado/{id}
                const response = await $.ajax({
                    url: urlCompleta + "/ver/" + id, // Ajustado a la ruta correcta
                    method: "GET",
                    dataType: "json"
                });

                if (response.success && response.url) {
                    // Abrir el PDF en una nueva pestaña o ventana
                    window.open(response.url, '_blank');
                } else {
                    // Manejo si la respuesta es exitosa pero no tiene la URL (o tiene 'error: true')
                    notificacion.fire({
                        icon: "error",
                        title: "Error al obtener URL",
                        text: "No se pudo obtener la URL del certificado."
                    });
                }

            } catch (error) {
                // Manejo de errores de la llamada AJAX
                let errorText = "Ocurrió un error en el servidor o la URL no es válida.";
                if (error.responseJSON && error.responseJSON.message) {
                    errorText = error.responseJSON.message;
                }

                notificacion.fire({
                    icon: "error",
                    title: "Error de Visualización",
                    text: errorText
                });
            }
        };

        eliminar = function(id) {
            Swal.fire({
                title: '¿Está seguro de que desea eliminar el registro?',
                text: "¡No podrá revertir esta acción, y el estado de la preinscripcion volvera a su estado Anterior!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, ¡eliminar!',
                cancelButtonText: 'Cancelar'
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
                                    title: "¡Eliminado!",
                                    text: "Su registro fue eliminado."
                                });
                            } else {
                                notificacion.fire({
                                    icon: "error",
                                    title: "¡Error!",
                                    text: "Su registro no fue eliminado."
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            notificacion.fire({
                                title: "Error en el sistema",
                                text: "¡El registro no se agregó al sistema!",
                                icon: "error"
                            });
                        }
                    });
                }
            });
        };

        $(document).ready(function() {
            $('#estudiante_id').on('change', function() {
                var estudianteId = $(this).val();
                var cursoSelect = $('#curso_id');
                console.log(estudianteId);

                if (estudianteId) {
                    cursoSelect.prop('disabled', false);

                    cursoSelect.find('option:not(:first)').remove();

                    cursoSelect.append('<option value="">Cargando cursos...</option>');

                    $.ajax({
                        url: urlCompleta + '/estudianteInfo/' + estudianteId,
                        method: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            cursoSelect.find('option:not(:first)').remove();
                            if (response.cursos && response.cursos.length > 0) {
                                $.each(response.cursos, function(index, curso) {
                                    cursoSelect.append(
                                        $('<option></option>').attr('value', curso
                                            .id).text(curso.nombre)
                                    );
                                });
                            } else {
                                cursoSelect.append(
                                    '<option value="">No hay cursos disponibles</option>');
                            }
                        },
                        error: function() {
                            cursoSelect.find('option:not(:first)').remove();
                            cursoSelect.append(
                                '<option value="">Error al cargar cursos</option>');
                        }
                    });
                } else {
                    cursoSelect.prop('disabled', true);
                    cursoSelect.find('option:not(:first)').remove();
                }
            });


            $('#codigo_certificado').on('input', function() {
                $(this).val($(this).val().replace(/[^A-Za-z0-9]/g, ''));
            });

            $('#codigo_certificado').on('paste', function(e) {
                e.preventDefault();
                var pastedText = (e.originalEvent.clipboardData || window.clipboardData).getData('text');
                var cleanedText = pastedText.replace(/[^A-Za-z0-9]/g, '');
                document.execCommand('insertText', false, cleanedText);
            });

            $('#codigo_certificado').on('keypress', function(e) {
                if (e.which === 32) {
                    e.preventDefault();
                }
            });
        });

        // FIN ACCIONES
    </script>
@endsection
