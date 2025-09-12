@extends('interno.app.app')
@section('page', 'Gestion Preinscripciones')
@section('tittle', 'Gestion Preinscripciones')

@section('contenido')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 text-center">
                    <h3>Gestion Preinscripciones</h3>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="container mt-4">
                        <table class="table align-items-center mb-0 display responsive nowrap" cellspacing="0" id="datatable"
                            style="width: 100%">
                            <thead>
                                <tr>
                                    <th data-priority="1">Cliente</th>
                                    <th>Curso</th>
                                    <th>Estado</th>
                                    <th>Comentario</th>
                                    <th>Fecha Registro</th>
                                    <th data-priority="2">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Cliente</th>
                                    <th>Curso</th>
                                    <th>Estado</th>
                                    <th>Comentario</th>
                                    <th>Fecha Registro</th>
                                    <th>Acciones</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de confirmación para Aceptar/Anular -->
    <div class="modal fade" id="modalConfirmacion" tabindex="-1" role="dialog" aria-labelledby="modalConfirmacionLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" id="modalHeader">
                    <h5 class="modal-title text-white" id="modalConfirmacionLabel">Confirmar acción</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formConfirmacion">
                        @csrf
                        <input type="hidden" id="preinscripcion_id" name="preinscripcion_id">
                        <input type="hidden" id="accion" name="accion">
                        
                        <div class="mb-3">
                            <p id="textoConfirmacion">¿Está seguro que desea realizar esta acción?</p>
                        </div>
                        
                        <div class="mb-3">
                            <label for="comentario" class="form-label">Comentario (opcional, máximo 100 caracteres)</label>
                            <textarea class="form-control" id="comentario" name="comentario" rows="3" maxlength="100" 
                                placeholder="Ingrese un comentario breve sobre la acción"></textarea>
                            <div class="form-text"><span id="contadorCaracteres">0</span>/100 caracteres</div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn" id="btnConfirmarAccion">Confirmar</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        var token = $('meta[name="csrf-token"]').attr('content');
        var urlCompleta = window.location.href;
        var accionActual = '';

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
                    data: 'cliente_registrado.identidad',
                    name: 'user.dni',
                    className: 'text-center',
                },
                {
                    data: 'curso.nombre',
                    name: 'curso.nombre',
                    className: 'text-center',
                },
                {
                    data: 'estado',
                    name: 'estado',
                    className: 'text-center',
                    render: function(data, type, row) {
                        if (data === 'Aceptado') {
                            return '<span class="badge bg-success">Aceptado</span>';
                        } else if (data === 'Pendiente') {
                            return '<span class="badge bg-warning">Requiere Acción</span>';
                        } else if (data === 'Negado') {
                            return '<span class="badge bg-danger">Cancelado</span>';
                        }
                        return data;
                    }
                },
                {
                    data: 'comentario',
                    name: 'comentario',
                    className: 'text-center',
                    render: function(data, type, row) {
                        if (data === null) {
                            return '<span class="badge bg-info">Sin Informacion</span>';
                        } else {
                            return data;
                        }
                        return data;
                    }
                },
                {
                    data: 'fecha_creacion_formateada',
                    name: 'fecha_creacion_formateada',
                    className: 'text-center',
                }, {
                    "data": null,
                    "className": "align-middle text-center",
                    "render": function(data, type, row, meta) {
                        let botones = '';
                        
                        if (row.estado === 'Pendiente') {
                            botones = `
                                <div class="dropdown">
                                    <button class="btn btn-link text-secondary mb-0" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" data-bs-placement="right">
                                        <i class="fa fa-ellipsis-v text-xs"></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item" href="javascript:abrirModalConfirmacion(${row.id}, 'aceptar');"><i class="fas fa-check-circle text-success"></i> Aceptar</a></li>
                                        <li><a class="dropdown-item" href="javascript:abrirModalConfirmacion(${row.id}, 'anular');"><i class="fas fa-times-circle text-danger"></i> Anular</a></li>
                                    </ul>
                                </div>`;
                        } else {
                            botones = '<span class="badge bg-secondary">Acción realizada</span>';
                        }
                        
                        return botones;
                    },
                    "orderable": false
                },
            ],
            columnDefs: [{
                orderable: false,
                targets: [5, 3],
                responsivePriority: 1,
                responsivePriority: 2,
            }],
            language: {
                "zeroRecords": "Ningún resultado encontrado",
                "emptyTable": "Ningún dato disponible en esta tabla",
                "lengthMenu": "Mostrar _MENU_ registros",
                "info": "Mostrando de _START_ a _END_ de un total de _TOTAL_ registros",
                "infoEmpty": "Mostrando de 0 a 0 de un total de 0 registros",
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

        // Función para abrir el modal de confirmación
        function abrirModalConfirmacion(id, accion) {
            $('#preinscripcion_id').val(id);
            $('#accion').val(accion);
            $('#comentario').val('');
            $('#contadorCaracteres').text('0');
            
            // Configurar el texto y colores según la acción
            if (accion === 'aceptar') {
                // Estilo para ACEPTAR (verde)
                $('#modalHeader').removeClass('bg-danger').addClass('bg-success');
                $('#modalConfirmacionLabel').html('Confirmar aceptación');
                $('#textoConfirmacion').html('¿Está seguro que desea <strong>aceptar</strong> esta preinscripción?');
                $('#btnConfirmarAccion').removeClass('btn-danger').addClass('btn-success').html('<i class="fas fa-check"></i> Aceptar');
            } else {
                // Estilo para ANULAR (rojo)
                $('#modalHeader').removeClass('bg-success').addClass('bg-danger');
                $('#modalConfirmacionLabel').html('Confirmar anulación');
                $('#textoConfirmacion').html('¿Está seguro que desea <strong>anular</strong> esta preinscripción?');
                $('#btnConfirmarAccion').removeClass('btn-success').addClass('btn-danger').html('<i class="fas fa-times"></i> Anular');
            }
            
            $('#modalConfirmacion').modal('show');
        }

        // Contador de caracteres para el comentario
        $('#comentario').on('input', function() {
            let longitud = $(this).val().length;
            $('#contadorCaracteres').text(longitud);
            
            if (longitud > 100) {
                $(this).val($(this).val().substring(0, 100));
                $('#contadorCaracteres').text('100').addClass('text-danger');
            } else {
                $('#contadorCaracteres').removeClass('text-danger');
            }
        });

        // Confirmar la acción
        $('#btnConfirmarAccion').on('click', function() {
            let id = $('#preinscripcion_id').val();
            let accion = $('#accion').val();
            let comentario = $('#comentario').val();
            
            // Realizar la petición AJAX
            $.ajax({
                url: urlCompleta + '/' + accion + '/' + id,
                method: "POST",
                data: {
                    _token: token,
                    comentario: comentario
                },
                beforeSend: function() {
                    $('#btnConfirmarAccion').prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Procesando...');
                },
                success: function(response) {
                    if (response.success) {
                        // Notificación de éxito
                        Swal.fire({
                            icon: 'success',
                            title: '¡Éxito!',
                            text: response.message || 'La acción se realizó correctamente.',
                            timer: 2000,
                            showConfirmButton: false
                        });
                        
                        // Cerrar modal y recargar tabla
                        $('#modalConfirmacion').modal('hide');
                        table.ajax.reload(null, false);
                    } else {
                        // Notificación de error
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message || 'Ocurrió un error al procesar la acción.'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    // Notificación de error en caso de fallo de la solicitud
                    Swal.fire({
                        icon: 'error',
                        title: 'Error de conexión',
                        text: 'Ocurrió un error al intentar realizar la acción. Código de estado: ' + xhr.status
                    });
                },
                complete: function() {
                    $('#btnConfirmarAccion').prop('disabled', false);
                    if (accion === 'aceptar') {
                        $('#btnConfirmarAccion').html('<i class="fas fa-check"></i> Aceptar');
                    } else {
                        $('#btnConfirmarAccion').html('<i class="fas fa-times"></i> Anular');
                    }
                }
            });
        });
    </script>
@endsection