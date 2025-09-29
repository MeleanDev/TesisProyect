@extends('interno.app.app')
@section('page', 'Recepcion De Mensajes')
@section('tittle', 'Recepcion De Mensajes')

@section('contenido')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 text-center">
                    <h3>Recepcion De Mensajes</h3>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <button onclick="crear()" class="btn bg-gradient-primary btn-sm pb-2 ms-4">
                        Agregar Administrador
                    </button>
                    <div class="container mt-4">
                        <table class="table align-items-center mb-0 display responsive nowrap" cellspacing="0" id="datatable"
                            style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Correo</th>
                                    <th>Telefono</th>
                                    <th>Asunto</th>
                                    <th class="text-center" data-priority="2">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Correo</th>
                                    <th>Telefono</th>
                                    <th>Asunto</th>
                                    <th class="text-center">Acción</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        var token = $('meta[name="csrf-token"]').attr('content');
        var rotaAcao = "";
        var acao = 0;
        const urlCompleta = window.location.href;

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
                    data: 'name',
                    name: 'name',
                    className: 'text-center',
                },
                {
                    data: 'email',
                    name: 'email',
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
                targets: [2],
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
                        if (acao ===
                            1) {
                            notificacao.fire({
                                icon: "success",
                                title: "¡Información guardada!",
                                text: "Registro guardado con éxito."
                            });
                        } else {
                            notificacao.fire({
                                icon: "success",
                                title: "¡Información editada!",
                                text: "Registro editado con éxito."
                            });
                        }
                    } else {
                        notificacao.fire({
                            icon: "error",
                            title: "Registro no cargado.",
                            text: data.message ||
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
            acao = 1;

            // reinicializar Formulario
            $("#formulario").trigger("reset");

            // Editar Modal
            $("#titulo").html("Agregar Administrador");
            $("#titulo").attr("class", "modal-title text-white");
            $("#bg-titulo").attr("class", "modal-header bg-gradient-primary");

            $("#name").attr("readonly", false);
            $("#email").attr("readonly", false);
            $("#password").attr("readonly", false);

            $('#submit').show()
            $('#modalCRUD').modal('show');
        };

        ver = async function(id) {
            try {
                $("#formulario").trigger("reset");
                datos = await consulta(id);
                $("#titulo").html("Ver Administrador -> " + datos.email);
                $("#titulo").attr("class", "modal-title text-white");
                $("#bg-titulo").attr("class", "modal-header bg-info");

                // atribución de valores
                $("#name").val(datos.name);
                $("#name").attr("readonly", true);

                $("#email").val(datos.email);
                $("#email").attr("readonly", true);

                $("#password").attr("readonly", true);

                $('#submit').hide()
                $('#modalCRUD').modal('show');
            } catch (error) {
                notificacao.fire({
                    icon: "error",
                    title: "¡Eliminado!",
                    text: "Su registro no se puede visualizar."
                });
            }
        };

        editar = async function(id) {
            rotaAcao = urlCompleta + "/editar/" + id;
            acao = 2;
            try {
                $("#formulario").trigger("reset");
                datos = await consulta(id);
                $("#titulo").html("Editar Administrador -> " + datos.email);
                $("#titulo").attr("class", "modal-title text-white");
                $("#bg-titulo").attr("class", "modal-header bg-warning");

                // atribución de valores
                $("#name").val(datos.name);
                $("#name").attr("readonly", false);

                $("#email").val(datos.email);
                $("#email").attr("readonly", false);

                $("#password").attr("readonly", false);

                $('#submit').show()
                $('#modalCRUD').modal('show');
            } catch (error) {
                notificacao.fire({
                    icon: "error",
                    title: "¡Eliminado!",
                    text: "Su registro no se puede visualizar."
                });
            }
        };

        eliminar = function(id) {
            Swal.fire({
                title: '¿Está seguro de que desea eliminar el registro?',
                text: "¡No podrá revertir esta acción!",
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
                                notificacao.fire({
                                    icon: "success",
                                    title: "¡Eliminado!",
                                    text: "Su registro fue eliminado."
                                });
                            } else {
                                notificacao.fire({
                                    icon: "error",
                                    title: "¡Error!",
                                    text: "Su registro no fue eliminado."
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                title: "Error en el sistema",
                                text: "¡El registro no se agregó al sistema!",
                                icon: "error"
                            });
                        }
                    });
                }
            });
        };

        // FIN ACCIONES
    </script>
@endsection
