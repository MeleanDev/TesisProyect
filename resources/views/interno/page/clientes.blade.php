@extends('interno.app.app')
@section('page', 'Gestion Cliente')
@section('tittle', 'Gestion Cliente')

@section('contenido')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 text-center">
                    <h3>Gestion Cliente</h3>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <button onclick="crear()" class="btn bg-gradient-primary btn-sm pb-2 ms-4">Añadir Cliente</button>
                    <div class="container mt-4">
                        <table class="table align-items-center mb-0 display responsive nowrap" cellspacing="0" id="datatable"
                            style="width: 100%">
                            <thead>
                                <tr>
                                    <th data-priority="1">Identificacion</th>
                                    <th data-priority="2">Imagen</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Email</th>
                                    <th>Telefone</th>
                                    <th>Fecha Nacimt.</th>
                                    <th class="text-center" data-priority="3">Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Identificacion</th>
                                    <th>Imagen</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Email</th>
                                    <th>Telefone</th>
                                    <th>Fecha Nacimt.</th>
                                    <th>Accion</th>
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
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 text-center" id="image-display" style="display: none;">
                                <img id="modal-image" src="" alt="Client Image" style="width: 150px; height: 150px; object-fit: cover; border-radius: 50%;">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Pnombre" class="form-control-label">Primer Nombre</label>
                                    <input type="text" class="form-control" id="Pnombre" name="Pnombre"
                                        placeholder="Primer Nombre" maxlength="100" minlength="2" required>
                                    <small class="form-text">Primer Nombre (Obrigatório)</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Snombre" class="form-control-label">Segundo Nombre</label>
                                    <input type="text" class="form-control" id="Snombre" name="Snombre" maxlength="100"
                                        minlength="2" placeholder="Segundo Nombre">
                                    <small class="form-text">Segundo Nombre (Opcional)</small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Papelldio" class="form-control-label">Primer Apellido</label>
                                    <input type="text" class="form-control" id="Papelldio" name="Papelldio"
                                        placeholder="Primer Apellido" maxlength="100" minlength="2" required>
                                    <small class="form-text">Primer Apellido (Obrigatório)</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Sapelldio" class="form-control-label">Segundo Apellido</label>
                                    <input type="text" class="form-control" id="Sapelldio" name="Sapelldio"
                                        maxlength="100" minlength="2" placeholder="Segundo Apellido">
                                    <small class="form-text">Segundo Apellido (Opcional)</small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="identidad" class="form-control-label">Cédula</label>
                                    <input type="text" class="form-control" id="identidad" name="identidad"
                                        placeholder="Número de Cédula" maxlength="20" required>
                                    <small class="form-text">Cédula (Obrigatório)</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="telefono" class="form-control-label">Teléfono</label>
                                    <input type="tel" class="form-control" id="telefono" name="telefono"
                                        placeholder="Número de Teléfono" maxlength="20">
                                    <small class="form-text">Teléfono (Opcional)</small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email" class="form-control-label">E-mail</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="E-mail" required>
                                    <small class="form-text">E-mail (Obrigatório)</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fecha_nacimiento" class="form-control-label">Fecha de Nacimiento</label>
                                    <input type="date" class="form-control" id="fecha_nacimiento"
                                        name="fecha_nacimiento" required>
                                    <small class="form-text">Fecha de Nacimiento (Obrigatório)</small>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="image-upload-row">
                             <div class="col-md-12">
                                <div class="form-group">
                                    <label for="image" class="form-control-label">Imagen</label>
                                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                    <small class="form-text">Selecciona una imagen para el cliente (Opcional)</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-danger text-white" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" id="submit" class="btn bg-gradient-success">Salvar</button>
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
                    data: 'identidad',
                    name: 'identidad',
                    className: 'text-center',
                },
                {
                    data: 'image',
                    name: 'image',
                    className: 'text-center',
                    render: function(data, type, row) {
                        if (row.image) {
                            return `<img src="${row.image}" width="100" height="100" style="object-fit: cover; border-radius: 50%;">`;
                        } else {
                            return '<span class="text-muted">Imagem não disponível</span>';
                        }
                    }
                },
                {
                    data: 'Pnombre',
                    name: 'Pnombre',
                    className: 'text-center',
                    render: function(data, type, row) {
                        if (row.Pnombre) {
                            return row.Pnombre + ' ' + (row.Snombre || '');
                        } else {
                            return 'Error al Obtener Dato';
                        }
                    }
                },
                {
                    data: 'Papelldio',
                    name: 'Papelldio',
                    className: 'text-center',
                    render: function(data, type, row) {
                        if (row.Papelldio) {
                            return row.Papelldio + ' ' + (row.Sapelldio || '');
                        } else {
                            return 'Error al Obtener Dato';
                        }
                    }
                },
                {
                    data: 'email',
                    name: 'email',
                    className: 'text-center',
                },
                {
                    data: 'telefono',
                    name: 'telefono',
                    className: 'text-center',
                },
                {
                    data: 'fecha_nacimiento',
                    name: 'fecha_nacimiento',
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
                targets: [4],
                responsivePriority: 1,
                responsivePriority: 2,

            }],
            language: {
                "zeroRecords": "Nenhum resultado encontrado",
                "emptyTable": "Nenhum dado disponível nesta tabela",
                "lengthMenu": "Mostrar _MENU_ registros",
                "info": "Mostrando registros de _START_ a _END_ de um total de _TOTAL_ registros",
                "infoEmpty": "Mostrando registros de 0 a 0 de um total de 0 registros",
                "infoFiltered": "(filtrado de um total de _MAX_ registros)",
                "sSearch": "Buscar:",
                "oPaginate": {
                    "sFirst": "Primeiro",
                    "sLast": "Último",
                    "sNext": "Próximo",
                    "sPrevious": "Anterior"
                },
                "sProcessing": "Processando...",
            },
        });

        //  Consultas EndPoint
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

        // Enviar dados
        $('#formulario').submit(function(e) {
            e.preventDefault();
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
                                title: "¡Información guardada!",
                                text: "Registro guardado con éxito."
                            });
                        } else {
                            notificacion.fire({
                                icon: "success",
                                title: "¡Información editada!",
                                text: "Registro editado con éxito."
                            });
                        }
                    } else {
                        notificacion.fire({
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
            rutaAccion = urlCompleta;
            accion = 1;

            // reinicial Formulario
            $("#formulario").trigger("reset");

            // Editar Modal
            $("#titulo").html("Adicionar Cliente");
            $("#titulo").attr("class", "modal-title text-white");
            $("#bg-titulo").attr("class", "modal-header bg-gradient-primary");

            $("#image-upload-row").show();
            $("#image-display").hide();
            $("#modal-image").attr("src", "");

            $("#Pnombre").attr("readonly", false);
            $("#Snombre").attr("readonly", false);
            $("#Papelldio").attr("readonly", false);
            $("#Sapelldio").attr("readonly", false);
            $("#identidad").attr("readonly", false);
            $("#telefono").attr("readonly", false);
            $("#email").attr("readonly", false);
            $("#fecha_nacimiento").attr("readonly", false);

            $('#submit').show()
            $('#modalCRUD').modal('show');
        };

        ver = async function(id) {
            try {
                $("#formulario").trigger("reset");
                datos = await consulta(id);
                $("#titulo").html("Ver Cliente -> " + datos.datos.identidad);
                $("#titulo").attr("class", "modal-title text-white");
                $("#bg-titulo").attr("class", "modal-header bg-info");

                // Asignación de valores
                $("#Pnombre").val(datos.datos.Pnombre);
                $("#Pnombre").attr("readonly", true);

                $("#Snombre").val(datos.datos.Snombre);
                $("#Snombre").attr("readonly", true);

                $("#Papelldio").val(datos.datos.Papelldio);
                $("#Papelldio").attr("readonly", true);

                $("#Sapelldio").val(datos.datos.Sapelldio);
                $("#Sapelldio").attr("readonly", true);

                $("#identidad").val(datos.datos.identidad);
                $("#identidad").attr("readonly", true);

                $("#telefono").val(datos.datos.telefono);
                $("#telefono").attr("readonly", true);

                $("#email").val(datos.datos.email);
                $("#email").attr("readonly", true);

                $("#fecha_nacimiento").val(datos.datos.fecha_nacimiento);
                $("#fecha_nacimiento").attr("readonly", true);

                // Mostrar la imagen
                if (datos.datos.image) {
                    $("#modal-image").attr("src", datos.datos.image);
                    $("#image-display").show();
                } else {
                    $("#modal-image").attr("src", "");
                    $("#image-display").hide();
                }

                $("#image-upload-row").hide();
                $('#submit').hide()
                $('#modalCRUD').modal('show');
            } catch (error) {
                notificacion.fire({
                    icon: "error",
                    title: "Erro!",
                    text: "No se puede ver el registro."
                });
            }
        };

        editar = async function(id) {
            rutaAccion = urlCompleta + "/editar/" + id;
            accion = 2;
            try {
                $("#formulario").trigger("reset");
                datos = await consulta(id);
                $("#titulo").html("Editar Cliente -> " + datos.datos.identidad);
                $("#titulo").attr("class", "modal-title text-white");
                $("#bg-titulo").attr("class", "modal-header bg-warning");

                // Asignación de valores
                $("#Pnombre").val(datos.datos.Pnombre);
                $("#Pnombre").attr("readonly", false);
                $("#Snombre").val(datos.datos.Snombre);
                $("#Snombre").attr("readonly", false);

                $("#Papelldio").val(datos.datos.Papelldio);
                $("#Papelldio").attr("readonly", false);
                $("#Sapelldio").val(datos.datos.Sapelldio);
                $("#Sapelldio").attr("readonly", false);

                $("#identidad").val(datos.datos.identidad);
                $("#identidad").attr("readonly", false);

                $("#telefono").val(datos.datos.telefono);
                $("#telefono").attr("readonly", false);

                $("#email").val(datos.datos.email);
                $("#email").attr("readonly", false);

                $("#fecha_nacimiento").val(datos.datos.fecha_nacimiento);
                $("#fecha_nacimiento").attr("readonly", false);

                if (datos.datos.image) {
                    $("#modal-image").attr("src", datos.datos.image);
                    $("#image-display").show();
                } else {
                    $("#modal-image").attr("src", "");
                    $("#image-display").hide();
                }

                $("#image-upload-row").show();
                $('#submit').show()
                $('#modalCRUD').modal('show');
            } catch (error) {
                notificacion.fire({
                    icon: "error",
                    title: "Erro!",
                    text: "No se puede ver el registro."
                });
            }
        };

        eliminar = function(id) {
            Swal.fire({
                title: '¿Está seguro que desea eliminar el registro?',
                text: "¡Esto no lo podrás revertir!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, borrar!',
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
                                    title: "Excluído!",
                                    text: "Su registro ha sido eliminado"
                                });
                            } else {
                                notificacion.fire({
                                    icon: "error",
                                    title: "Erro!",
                                    text: "Su registro no ha sido eliminado"
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                title: "Error en el Sistema",
                                text: "¡¡El sistema no registro la accion!!",
                                icon: "error"
                            });
                        }
                    });
                }
            });
        };

        // FIM AÇÕES
    </script>
@endsection