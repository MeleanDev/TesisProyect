@extends('dashboard.app.app')
@section('page', 'Produtos')
@section('tittle', 'Produtos')

@section('contenido')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 text-center">
                    <h3>Produtos</h3>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <button onclick="crear()" class="btn bg-gradient-primary btn-sm pb-2 ms-4">Adicionar Produto</button>
                    <div class="container mt-4">
                        <table class="table align-items-center mb-0 display responsive nowrap" cellspacing="0" id="datatable"
                            style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Imagem</th>
                                    <th data-priority="1">Nome</th>
                                    <th>Categoria</th>
                                    <th>Preço</th>
                                    <th>Estoque</th>
                                    <th class="text-center" data-priority="2">Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Imagem</th>
                                    <th>Nome</th>
                                    <th>Categoria</th>
                                    <th>Preço</th>
                                    <th>Estoque</th>
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
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <img id="preview" src="" width="150" height="150">
                        </div>
                        {{-- Foto --}}
                        <div class="form-group">
                            <label for="image" id="imageTitle">Foto do Produto || Somente formatos (JPG E PNG)</label>
                            <input type="file" id="image" name="image" class="form-control" accept=".jpg,.png"
                                onchange="previewImage()" required>
                            <small class="form-text" id="imagesmall">Foto do Produto (Obrigatório)</small>
                        </div>
                        <div class="row">
                            {{-- Categoria --}}
                            <div class="form-group text-center col-6">
                                <label for="category">Categoria do Produto.</label>
                                <input type="hidden" class="form-control" id="categoryVer" readonly>
                                <select class="form-control mb-2" id="category" name="category" style="width: 100%"
                                    required>
                                    <option value="Doces" selected>Doces</option>
                                    <option value="Bebidas">Bebidas</option>
                                    <option value="Cereais">Cereais</option>
                                    <option value="Farinhas">Farinhas</option>
                                </select>
                                <small id="categorysmall" class="form-text">Categoria do Produto (Obrigatório)</small>
                            </div>
                            {{-- Nome --}}
                            <div class="form-group text-center col-6">
                                <label for="name">Nome do produto</label>
                                <input type="text" class="form-control" id="name" name="name" minlength="3"
                                    maxlength="100" placeholder="Nome do Produto." required>
                                <small id="namesmall" class="form-text">Nome do produto (Obrigatório)</small>
                            </div>
                        </div>
                        {{-- Descricao --}}
                        <div class="form-group text-center">
                            <label for="description">Descrição do Produto.</label>
                            <textarea class="form-control" id="description" name="description" minlength="1" placeholder="Descrição do Produto."
                                rows="3" required></textarea>
                            <small id="descriptionsmall" class="form-text">Descrição do Produto (Obrigatório)</small>
                        </div>
                        {{-- Preço e Quantidade --}}
                        <div class="row mb-4">
                            <div class="col-6">
                                <label for="stock" class="form-label">Quantidade do Produto</label>
                                <input type="number" class="form-control" id="stock" name="stock" required
                                    min="1" placeholder="Quantidade disponível do produto.">
                                <small id="stocksmall" class="form-text">Quantidade do Produto (Obrigatório)</small>
                            </div>
                            <div class="col-6">
                                <label for="price" class="form-label">Preço do Produto</label>
                                <input type="number" class="form-control" id="price" name="price" required
                                    min="1" placeholder="Preço do produto." step="0.01">
                                <small id="pricesmall" class="form-text">Preço do Produto (Obrigatório)</small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn bg-danger text-white"
                                data-bs-dismiss="modal">Fechar</button>
                            <button type="submit" id="submit" class="btn bg-gradient-success">Salvar</button>
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
                    data: 'image',
                    name: 'image',
                    className: 'text-center',
                    render: function(data, type, row) {
                        if (row.image) {
                            return '<img src="' + row.image + '" width="100" height="100">';
                        } else {
                            return '<span class="text-muted">Imagem não disponível</span>';
                        }
                    }
                },
                {
                    data: 'name',
                    name: 'name',
                    className: 'text-center',
                },
                {
                    data: 'category',
                    name: 'category',
                    className: 'text-center',
                },
                {
                    data: 'price',
                    name: 'price',
                    className: 'text-center',
                },
                {
                    data: 'stock',
                    name: 'stock',
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
                targets: [5, 0],
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
            e.preventDefault(); // Previne o recarregamento da página

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
                                title: "Informação Salva!!",
                                text: "Registro salvo com sucesso."
                            });
                        } else {
                            notificacion.fire({
                                icon: "success",
                                title: "Informação Editada!!",
                                text: "Registro editado com sucesso."
                            });
                        }
                    } else {
                        notificacion.fire({
                            icon: "error",
                            title: "Registro não carregado.",
                            text: "Lembre-se que não podem haver 2 Clientes com o mesmo CPF."
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

            $('#modalCRUD').modal('hide'); // Fecha o modal após a solicitação AJAX
        });

        // AÇÕES
        crear = function() {
            rutaAccion = urlCompleta + "/Crear";
            accion = 1;

            // reinicializar Formulário
            $("#formulario").trigger("reset");

            // atribuição de valores
            $("#preview").attr("src", "{{ asset('assets/img/stock.png') }}");

            $('#image').show();
            $("#image").attr("required", true);
            $('#imageTitle').show();
            $('#imagesmall').show();

            $("#name").attr("readonly", false);
            $('#namesmall').show();

            $("#description").attr("readonly", false);
            $('#descriptionsmall').show();

            $('#categoryVer').attr('type', 'hidden');
            $('#categorysmall').show();
            $('#category').show();

            $("#price").attr("readonly", false);
            $('#pricesmall').show();

            $("#stock").attr("readonly", false);
            $('#stocksmall').show();

            $('#submit').show()

            // Editar Modal
            $("#titulo").html("Adicionar Produtos");
            $("#titulo").attr("class", "modal-title text-white");
            $("#bg-titulo").attr("class", "modal-header bg-gradient-primary");
            $('#modalCRUD').modal('show');
        };

        ver = async function(id) {
            try {
                $("#formulario").trigger("reset");
                datos = await consulta(id);
                $("#titulo").html("Ver Produto -> " + datos.name);
                $("#titulo").attr("class", "modal-title text-white");
                $("#bg-titulo").attr("class", "modal-header bg-info");

                // atribuição de valores
                $('#preview').attr("src", datos.image);

                $('#image').hide();
                $('#imageTitle').hide();
                $('#imagesmall').hide();

                $("#name").val(datos.name);
                $("#name").attr("readonly", true);
                $('#namesmall').hide();

                $("#description").val(datos.description);
                $("#description").attr("readonly", true);
                $('#descriptionsmall').hide();

                $('#categoryVer').attr('type', 'text');
                $("#categoryVer").val(datos.category);
                $('#categorysmall').hide();
                $('#category').hide();

                $("#price").val(datos.price);
                $("#price").attr("readonly", true);
                $('#pricesmall').hide();

                $("#stock").val(datos.stock);
                $("#stock").attr("readonly", true);
                $('#stocksmall').hide();

                $('#submit').hide()
                $('#modalCRUD').modal('show');
            } catch (error) {
                notificacion.fire({
                    icon: "error",
                    title: "¡ Excluído !",
                    text: "Seu registro não pode ser visualizado."
                });
            }
        };

        editar = async function(id) {
            rutaAccion = urlCompleta + "/Editar/" + id;
            accion = 2
            try {
                $("#formulario").trigger("reset");
                datos = await consulta(id);
                $("#titulo").html("Editar Produto -> " + datos.name);
                $("#titulo").attr("class", "modal-title text-white");
                $("#bg-titulo").attr("class", "modal-header bg-warning");

                // atribuição de valores
                $("#preview").attr("src", datos.image);

                $('#image').show();
                $("#image").attr("required", false);
                $('#imageTitle').show();
                $('#imagesmall').show();

                $("#name").attr("readonly", false);
                $("#name").val(datos.name);
                $('#namesmall').show();

                $("#description").attr("readonly", false);
                $("#description").val(datos.description);
                $('#descriptionsmall').show();

                $('#categoryVer').attr('type', 'hidden');
                $('#categorysmall').show();
                $("#category").val(datos.category);

                $('#category').show();

                $("#price").attr("readonly", false);
                $("#price").val(datos.price);
                $('#pricesmall').show();

                $("#stock").attr("readonly", false);
                $("#stock").val(datos.stock);
                $('#stocksmall').show();

                $('#submit').show()
                $('#modalCRUD').modal('show');
            } catch (error) {
                notificacion.fire({
                    icon: "error",
                    title: "¡ Excluído !",
                    text: "Seu registro não pode ser visualizado."
                });
            }
        };

        eliminar = function(id) {
            Swal.fire({
                title: 'Tem certeza de que deseja excluir o registro?',
                text: "Você não poderá reverter isso!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, exclua!',
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
                                    title: "¡ Excluído !",
                                    text: "Seu registro foi excluído."
                                });
                            } else {
                                notificacion.fire({
                                    icon: "error",
                                    title: "¡ Erro !",
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
                preview.src = "{{ asset('assets/img/stock.png') }}"; // Rota padrão se não houver imagem
            }
        }

        // FIM AÇÕES
    </script>
@endsection
