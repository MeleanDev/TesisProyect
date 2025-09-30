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

        // ACCIONES
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
        // FIN ACCIONES
    </script>
@endsection
