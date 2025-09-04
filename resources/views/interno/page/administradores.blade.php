@extends('dashboard.app.app')
@section('page', 'Administradores')
@section('tittle', 'Administradores')

@section('contenido')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 text-center">
                    <h3>Administradores</h3>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <button onclick="criar()" class="btn bg-gradient-primary btn-sm pb-2 ms-4">Adicionar Administrador</button>
                    <div class="container mt-4">
                        <table class="table align-items-center mb-0 display responsive nowrap" cellspacing="0" id="datatable"
                            style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Nomes</th>
                                    <th>Apelidos</th>
                                    <th data-priority="1">NIF/BI</th>
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
                                    <th>Apelidos</th>
                                    <th>NIF/BI</th>
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
                                    <label for="last_name" class="form-control-label">Apelido</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name"
                                        minlength="3" maxlength="50" placeholder="Apelido" required />
                                    <small class="form-text">Apelido (Obrigatório)</small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dni" class="form-control-label">NIF/BI</label>
                                    <input type="text" class="form-control" id="dni" name="dni"
                                        placeholder="Número de Identificação" minlength="5" maxlength="15" required>
                                    <small class="form-text">NIF / Bilhete de Identidade (Obrigatório)</small>
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
                                    <label for="email" class="form-control-label">Endereço de Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Endereço de Email" required>
                                    <small class="form-text">Endereço de Email (Obrigatório)</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password" class="form-control-label">Palavra-passe</label>
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Palavra-passe" minlength="6" required>
                                    <small class="form-text">Palavra-passe (Obrigatório, mínimo 8 caracteres)</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-danger text-white" data-bs-dismiss="modal">Fechar</button>
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
        var acao = 0;
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
                "lengthMenu": "Mostrar _MENU_ registos",
                "info": "A mostrar registos de _START_ a _END_ de um total de _TOTAL_ registos",
                "infoEmpty": "A mostrar registos de 0 a 0 de um total de 0 registos",
                "infoFiltered": "(filtrado de um total de _MAX_ registos)",
                "sSearch": "Procurar:",
                "oPaginate": {
                    "sFirst": "Primeiro",
                    "sLast": "Último",
                    "sNext": "Seguinte",
                    "sPrevious": "Anterior"
                },
                "sProcessing": "A processar...",
            },
        });

        //  Consultas EndPoint
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
                                title: "Informação Guardada!!",
                                text: "Registo guardado com sucesso."
                            });
                        } else {
                            notificacao.fire({
                                icon: "success",
                                title: "Informação Editada!!",
                                text: "Registo editado com sucesso."
                            });
                        }
                    } else {
                        notificacao.fire({
                            icon: "error",
                            title: "Registo não carregado.",
                            text: data.message ||
                                "Ocorreu um erro ao guardar o registo."
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        title: "Falha no sistema",
                        text: "O registo não foi adicionado ao sistema!!",
                        icon: "error"
                    });
                }
            });

            $('#modalCRUD').modal('hide');
        });

        // AÇÕES
        criar = function() {
            rotaAcao = urlCompleta + "/Criar";
            acao = 1;

            // reinicializar Formulário
            $("#formulario").trigger("reset");

            // Editar Modal
            $("#titulo").html("Adicionar Administrador");
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
                dados = await consulta(id);
                $("#titulo").html("Ver Administrador -> " + dados.dni);
                $("#titulo").attr("class", "modal-title text-white");
                $("#bg-titulo").attr("class", "modal-header bg-info");

                // atribuição de valores
                $("#name").val(dados.name);
                $("#name").attr("readonly", true);

                $("#last_name").val(dados.last_name);
                $("#last_name").attr("readonly", true);

                $("#dni").val(dados.dni);
                $("#dni").attr("readonly", true);

                $("#phone").val(dados.phone);
                $("#phone").attr("readonly", true);

                $("#email").val(dados.email);
                $("#email").attr("readonly", true);

                $("#password").attr("readonly", true);

                $('#submit').hide()
                $('#modalCRUD').modal('show');
            } catch (error) {
                notificacao.fire({
                    icon: "error",
                    title: "Eliminado!",
                    text: "O seu registo não pode ser visualizado."
                });
            }
        };

        editar = async function(id) {
            rotaAcao = urlCompleta + "/Editar/" + id;
            acao = 2;
            try {
                $("#formulario").trigger("reset");
                dados = await consulta(id);
                $("#titulo").html("Editar Administrador -> " + dados.dni);
                $("#titulo").attr("class", "modal-title text-white");
                $("#bg-titulo").attr("class", "modal-header bg-warning");

                // atribuição de valores
                $("#name").val(dados.name);
                $("#name").attr("readonly", false);

                $("#last_name").val(dados.last_name);
                $("#last_name").attr("readonly", false);

                $("#dni").val(dados.dni);
                $("#dni").attr("readonly", false);

                $("#phone").val(dados.phone);
                $("#phone").attr("readonly", false);

                $("#email").val(dados.email);
                $("#email").attr("readonly", false);

                $("#password").attr("readonly", false);

                $('#submit').show()
                $('#modalCRUD').modal('show');
            } catch (error) {
                notificacao.fire({
                    icon: "error",
                    title: "Eliminado!",
                    text: "O seu registo não pode ser visualizado."
                });
            }
        };

        eliminar = function(id) {
            Swal.fire({
                title: 'Tem a certeza que deseja eliminar o registo?',
                text: "Não poderá reverter esta ação!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, eliminar!',
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
                                notificacao.fire({
                                    icon: "success",
                                    title: "Eliminado!",
                                    text: "O seu registo foi eliminado."
                                });
                            } else {
                                notificacao.fire({
                                    icon: "error",
                                    title: "Erro!",
                                    text: "O seu registo não foi eliminado."
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                title: "Erro no sistema",
                                text: "O registo não foi adicionado ao sistema!!",
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