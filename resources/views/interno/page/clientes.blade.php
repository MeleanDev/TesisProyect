@extends('dashboard.app.app')
@section('page', 'Clientes')
@section('tittle', 'Clientes')

@section('contenido')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 text-center">
                    <h3>Clientes</h3>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <button onclick="crear()" class="btn bg-gradient-primary btn-sm pb-2 ms-4">Adicionar Cliente</button>
                    <div class="container mt-4">
                        <table class="table align-items-center mb-0 display responsive nowrap" cellspacing="0" id="datatable"
                            style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Nomes</th>
                                    <th>Sobrenomes</th>
                                    <th data-priority="1">CPF</th>
                                    <th>Email</th>
                                    <th>Telefone</th>
                                    <th class="text-center" data-priority="2">Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nomes</th>
                                    <th>Sobrenomes</th>
                                    <th>CPF</th>
                                    <th>Email</th>
                                    <th>Telefone</th>
                                    <th class="text-center">Ação</th>
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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="form-control-label">Nome</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Nome" minlength="3" maxlength="50" required>
                                    <small class="form-text">Nome (Obrigatório)</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="last_name" class="form-control-label">Sobrenome</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name"
                                        minlength="3" maxlength="50" placeholder="Sobrenome" required />
                                    <small class="form-text">Sobrenome (Obrigatório)</small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dni" class="form-control-label">CPF</label>
                                    <input type="text" class="form-control" id="dni" name="dni"
                                        placeholder="Número do Documento" minlength="5" maxlength="15" required>
                                    <small class="form-text">CPF / Cédula (Obrigatório)</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone" class="form-control-label">Telefone</label>
                                    <input type="tel" class="form-control" id="phone" name="phone"
                                        placeholder="Número de Telefone">
                                    <small class="form-text">Telefone (Opcional)</small>
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
                                    <label for="password" class="form-control-label">Senha</label>
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Senha" minlength="6" required>
                                    <small class="form-text">Senha (Obrigatório, mínimo 8 caracteres)</small>
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
            ajax: urlCompleta + '/Lista',
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
                    data: 'last_name',
                    name: 'last_name',
                    className: 'text-center',
                },
                {
                    data: 'dni',
                    name: 'dni',
                    className: 'text-center',
                },
                {
                    data: 'email',
                    name: 'email',
                    className: 'text-center',
                },
                {
                    data: 'phone',
                    name: 'phone',
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
                                <li><a class="dropdown-item" data-id="${row.id}" href="javascript:eliminar(${row.id});"><i class="fa fa-trash text-danger"></i> Excluir</a></li>
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
                    url: urlCompleta + "/Ver/" + id,
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
                        if (accion ===
                            1) {
                            notificacion.fire({
                                icon: "success",
                                title: "Informação Salva!",
                                text: "Registro salvo com sucesso."
                            });
                        } else {
                            notificacion.fire({
                                icon: "success",
                                title: "Informação Editada!",
                                text: "Registro editado com sucesso."
                            });
                        }
                    } else {
                        notificacion.fire({
                            icon: "error",
                            title: "Registro não carregado.",
                            text: data.message ||
                                "Ocorreu um erro ao salvar o registro."
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        title: "Falha no sistema",
                        text: "O registro não foi adicionado ao sistema!!",
                        icon: "error"
                    });
                }
            });

            $('#modalCRUD').modal('hide');
        });

        // ACCIONES
        crear = function() {
            rutaAccion = urlCompleta + "/Crear";
            accion = 1;

            // reinicial Formulario
            $("#formulario").trigger("reset");

            // Editar Modal
            $("#titulo").html("Adicionar Cliente");
            $("#titulo").attr("class", "modal-title text-white");
            $("#bg-titulo").attr("class", "modal-header bg-gradient-primary");

            $("#name").attr("readonly", false);
            $("#last_name").attr("readonly", false);
            $("#dni").attr("readonly", false);
            $("#phone").attr("readonly", false);
            $("#email").attr("readonly", false);
            $("#password").attr("readonly", false);

            $('#submit').show()
            $('#modalCRUD').modal('show');
        };

        ver = async function(id) {
            try {
                $("#formulario").trigger("reset");
                datos = await consulta(id);
                $("#titulo").html("Ver Cliente -> " + datos.dni);
                $("#titulo").attr("class", "modal-title text-white");
                $("#bg-titulo").attr("class", "modal-header bg-info");

                // asigancion de valores
                $("#name").val(datos.name);
                $("#name").attr("readonly", true);

                $("#last_name").val(datos.last_name);
                $("#last_name").attr("readonly", true);

                $("#dni").val(datos.dni);
                $("#dni").attr("readonly", true);

                $("#phone").val(datos.phone);
                $("#phone").attr("readonly", true);

                $("#email").val(datos.email);
                $("#email").attr("readonly", true);

                $("#password").attr("readonly", true);

                $('#submit').hide()
                $('#modalCRUD').modal('show');
            } catch (error) {
                notificacion.fire({
                    icon: "error",
                    title: "Erro!",
                    text: "Não foi possível visualizar o registro."
                });
            }
        };

        editar = async function(id) {
            rutaAccion = urlCompleta + "/Editar/" + id;
            accion = 2;
            try {
                $("#formulario").trigger("reset");
                datos = await consulta(id);
                $("#titulo").html("Editar Cliente -> " + datos.dni);
                $("#titulo").attr("class", "modal-title text-white");
                $("#bg-titulo").attr("class", "modal-header bg-warning");

                // asigancion de valores
                $("#name").val(datos.name);
                $("#name").attr("readonly", false);

                $("#last_name").val(datos.last_name);
                $("#last_name").attr("readonly", false);

                $("#dni").val(datos.dni);
                $("#dni").attr("readonly", false);

                $("#phone").val(datos.phone);
                $("#phone").attr("readonly", false);

                $("#email").val(datos.email);
                $("#email").attr("readonly", false);

                $("#password").attr("readonly", false);

                $('#submit').show()
                $('#modalCRUD').modal('show');
            } catch (error) {
                notificacion.fire({
                    icon: "error",
                    title: "Erro!",
                    text: "Não foi possível visualizar o registro."
                });
            }
        };

        eliminar = function(id) {
            Swal.fire({
                title: 'Tem certeza que deseja excluir o registro?',
                text: "Você não poderá reverter isso!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, excluir!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: urlCompleta + "/Eliminar/" + id,
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
                                    text: "Seu registro foi excluído."
                                });
                            } else {
                                notificacion.fire({
                                    icon: "error",
                                    title: "Erro!",
                                    text: "Seu registro não foi excluído."
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                title: "Erro no sistema",
                                text: "O registro não foi adicionado ao sistema!!",
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