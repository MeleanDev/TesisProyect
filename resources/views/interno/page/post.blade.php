@extends('dashboard.app.app')
@section('page', 'Postagens')
@section('tittle', 'Postagens')

@section('contenido')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 text-center">
                    <h3>Postagens</h3>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <button onclick="crear()" class="btn bg-gradient-primary btn-sm pb-2 ms-4">Adicionar Postagem</button>
                    <div class="container mt-4">
                        <table class="table align-items-center mb-0 display responsive nowrap" cellspacing="0" id="datatable"
                            style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Imagem</th>
                                    <th data-priority="1">Título</th>
                                    <th>Categoria</th>
                                    <th>Ingredientes</th>
                                    <th>Tempo de Cozimento</th>
                                    <th>Dificuldade</th>
                                    <th class="text-center" data-priority="2">Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Imagem</th>
                                    <th>Título</th>
                                    <th>Categoria</th>
                                    <th>Ingredientes</th>
                                    <th>Tempo de Cozimento</th>
                                    <th>Dificuldade</th>
                                    <th class="text-center">Ação</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalCRUD" tabindex="-1" aria-labelledby="modalCRUDLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <form id="formulario" enctype="multipart/form-data">
                    @csrf
                    <div id="bg-titulo" class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="titulo">Criar Nova Postagem</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Fechar"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center mb-4">
                            <img id="preview" src="https://via.placeholder.com/150?text=Previsualizar+Imagem"
                                alt="Pré-visualização da Imagem"
                                class="img-fluid rounded-circle border border-2 border-primary" width="150"
                                height="150">
                        </div>

                        {{-- Foto --}}
                        <div class="mb-3">
                            <label for="image" class="form-label" id="imageTitle">Imagem da Postagem <small
                                    class="text-muted">(Apenas JPG e PNG)</small></label>
                            <input type="file" id="image" name="image" class="form-control" accept=".jpg,.png"
                                onchange="previewImage()" required>
                            <small class="form-text text-muted" id="imagesmall">Carregue uma imagem atraente para sua postagem
                                (Obrigatório).</small>
                        </div>

                        <div class="row mb-3">
                            {{-- Categoria (Single Select) --}}
                            <div class="col-md-6 mb-3">
                                <label for="category" class="form-label">Categoria da Postagem</label>
                                <input type="hidder" class="form-control" id="categoryVer" readonly>
                                <select class="form-select" id="category" name="category" required>
                                    <option value="Salgados" selected>Salgados</option>
                                    <option value="Doces">Doces</option>
                                    <option value="Bebidas">Bebidas</option>
                                </select>
                                <small id="categorysmall" class="form-text text-muted">Escolha a categoria principal para sua
                                    publicação (Obrigatório).</small>
                            </div>
                            {{-- Titulo --}}
                            <div class="col-md-6 mb-3">
                                <label for="title" class="form-label">Título da Postagem</label>
                                <input type="text" class="form-control" id="title" name="title" minlength="3"
                                    maxlength="100" placeholder="Ex: Receita de Bolo de Chocolate" required>
                                <small id="titlesmall" class="form-text text-muted">Insira um título claro e conciso para
                                    sua postagem (Obrigatório).</small>
                            </div>
                        </div>

                        {{-- Produto relacionado --}}
                        <div class="mb-3">
                            <label for="product" class="form-label">Produto(s) relacionado(s)</label>
                            <input type="hidder" class="form-control" id="productVer" readonly>
                            <div id="productSelectContainer">
                                <select class="form-select" id="product" name="product[]" multiple>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                </select>
                                <small id="productsmall" class="form-text text-muted">Associe esta postagem a produtos
                                    específicos, se aplicável.</small>
                            </div>
                        </div>

                        {{-- Ingredientes --}}
                        <div class="mb-3">
                            <label for="ingredients" class="form-label">Ingredientes</label>
                            <textarea class="form-control" id="ingredients" name="ingredients" minlength="1"
                                placeholder="Ex: 2 xícaras de farinha, 1 ovo, 100g de açúcar..." rows="3"></textarea>
                            <small id="ingredientssmall" class="form-text text-muted">Detalhe os ingredientes necessários
                                para sua receita.</small>
                        </div>

                        {{-- Instruções --}}
                        <div class="mb-3">
                            <label for="instructions" class="form-label">Instruções</label>
                            <textarea class="form-control" id="instructions" name="instructions" minlength="1"
                                placeholder="Descreva passo a passo como preparar a receita ou o conteúdo da postagem." rows="5" required></textarea>
                            <small id="instructionssmall" class="form-text text-muted">Forneça instruções claras e
                                detalhadas (Obrigatório).</small>
                        </div>

                        <div class="row mb-3">
                            {{-- Tempo de Cocção --}}
                            <div class="col-md-6 mb-3">
                                <label for="cooking_time" class="form-label">Tempo de Preparo/Cozimento</label>
                                <input type="number" class="form-control" id="cooking_time" name="cooking_time"
                                    required placeholder="Ex: 30, 75.5" step="0.1">
                                <small id="cooking_timesmall" class="form-text text-muted">Indique o tempo estimado para
                                    esta postagem (Obrigatório).</small>
                            </div>
                            {{-- Dificuldade --}}
                            <div class="col-md-6 mb-3">
                                <label for="difficulty" class="form-label">Dificuldade</label>
                                <input type="hidder" class="form-control" id="difficultyVer" readonly>
                                <select class="form-select" id="difficulty" name="difficulty" required>
                                    <option value="easy">Fácil</option>
                                    <option value="medium">Média</option>
                                    <option value="hard">Difícil</option>
                                </select>
                                <small id="difficultysmall" class="form-text text-muted">Classifique a dificuldade de sua
                                    postagem (Obrigatório).</small>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" id="submit" class="btn btn-primary">Salvar Postagem</button>
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

        $('#modalCRUD').on('shown.bs.modal', function() {
            $('#product').select2({
                placeholder: "Selecione um ou mais produtos",
                allowClear: true,
                dropdownParent: $('#modalCRUD .modal-content'),
                minimumResultsForSearch: 10
            });
        });

        // Opcional: Se você quiser destruir o Select2 quando o modal for fechado para evitar problemas se abrir o modal várias vezes
        $('#modalCRUD').on('hidden.bs.modal', function() {
            if ($('#product').data('select2')) {
                $('#product').select2('destroy');
            }
        });

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
                    data: 'title',
                    name: 'title',
                    className: 'text-center',
                },
                {
                    data: 'category',
                    name: 'category',
                    className: 'text-center',
                },
                {
                    data: 'ingredients',
                    name: 'ingredients',
                    className: 'text-center',
                },
                {
                    data: 'cooking_time',
                    name: 'cooking_time',
                    className: 'text-center',
                },
                {
                    data: 'difficulty',
                    name: 'difficulty',
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
                "info": "Mostrando de _START_ a _END_ de um total de _TOTAL_ registros",
                "infoEmpty": "Mostrando de 0 a 0 de um total de 0 registros",
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

        // Consultas EndPoint
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
            e.preventDefault(); // Impede o recarregamento da página

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
                            text: "Lembre-se que não pode haver 2 clientes com o mesmo número de identificação."
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

            // Reinicializar Formulário
            $("#formulario").trigger("reset");

            // Atribuição de valores
            $("#preview").attr("src", "{{ asset('assets/img/post.png') }}");

            $('#image').show();
            $("#image").attr("required", true);
            $('#imageTitle').show();
            $('#imagesmall').show();

            $('#productVer').attr('type', 'hidden');
            $('#productsmall').show();
            $('#productSelectContainer').show();

            $('#categoryVer').attr('type', 'hidden');
            $('#categorysmall').show();
            $('#category').show();

            $("#title").attr("readonly", false);
            $('#titlesmall').show();

            $("#ingredients").attr("readonly", false);
            $('#ingredientssmall').show();

            $("#instructions").attr("readonly", false);
            $('#instructionssmall').show();

            $("#cooking_time").attr("readonly", false);
            $('#cooking_time').show();

            $('#difficultyVer').attr('type', 'hidden');
            $('#difficultysmall').show();
            $('#difficulty').show();

            $('#submit').show()

            // Editar Modal
            $("#titulo").html("Adicionar Postagem");
            $("#titulo").attr("class", "modal-title text-white");
            $("#bg-titulo").attr("class", "modal-header bg-gradient-primary");
            $('#modalCRUD').modal('show');
        };

        ver = async function(id) {
            try {
                $("#formulario").trigger("reset");
                datos = await consulta(id);
                $("#titulo").html("Ver Postagem -> " + datos.title);
                $("#titulo").attr("class", "modal-title text-white");
                $("#bg-titulo").attr("class", "modal-header bg-info");

                // Atribuição de valores
                $('#preview').attr("src", datos.image);

                $('#image').hide();
                $('#imageTitle').hide();
                $('#imagesmall').hide();

                $('#categoryVer').attr('type', 'text');
                $("#categoryVer").val(datos.category);
                $('#categorysmall').hide();
                $('#category').hide();

                $("#title").val(datos.title);
                $("#title").attr("readonly", true);
                $('#titlesmall').hide();

                $('#productVer').attr('type', 'text');
                $("#productVer").val(datos.product.map(p => p.name).join(', '));
                $('#productsmall').hide();
                $('#productSelectContainer').hide();

                $("#ingredients").val(datos.ingredients);
                $("#ingredients").attr("readonly", true);
                $('#ingredientssmall').hide();

                $("#instructions").val(datos.instructions);
                $("#instructions").attr("readonly", true);
                $('#instructionssmall').hide();

                $("#cooking_time").val(datos.cooking_time);
                $("#cooking_time").attr("readonly", true);
                $('#cooking_timesmall').hide();

                $('#difficultyVer').attr('type', 'text');
                $("#difficultyVer").val(datos.difficulty);
                $('#difficultysmall').hide();
                $('#difficulty').hide();

                $('#submit').hide()
                $('#modalCRUD').modal('show');
            } catch (error) {
                notificacion.fire({
                    icon: "error",
                    title: "Erro!",
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
                $("#titulo").html("Editar Postagem -> " + datos.title);
                $("#titulo").attr("class", "modal-title text-white");
                $("#bg-titulo").attr("class", "modal-header bg-warning");

                // Atribuição de valores
                $("#preview").attr("src", datos.image);

                $('#image').show();
                $("#image").attr("required", false);
                $('#imageTitle').show();
                $('#imagesmall').show();

                $('#categoryVer').attr('type', 'hidden');
                $('#categorysmall').show();
                $("#category").val(datos.category);
                $('#category').show();

                $("#title").attr("readonly", false);
                $("#title").val(datos.title);
                $('#titlesmall').show();

                $('#productVer').attr('type', 'hidden');
                $('#productsmall').show();
                $("#product").val(datos.product.map(p => p.id));
                $('#productSelectContainer').show();

                $("#ingredients").attr("readonly", false);
                $("#ingredients").val(datos.ingredients);
                $('#ingredientssmall').show();

                $("#instructions").attr("readonly", false);
                $("#instructions").val(datos.instructions);
                $('#instructionssmall').show();

                $("#cooking_time").attr("readonly", false);
                $("#cooking_time").val(datos.cooking_time);
                $('#cooking_timesmall').show();

                $('#difficultyVer').attr('type', 'hidden');
                $('#difficultysmall').show();
                $("#difficulty").val(datos.difficulty);
                $('#difficulty').show();

                $('#submit').show()
                $('#modalCRUD').modal('show');
            } catch (error) {
                notificacion.fire({
                    icon: "error",
                    title: "Erro!",
                    text: "Seu registro não pode ser visualizado."
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
                preview.src = "{{ asset('assets/img/post.png') }}"; // Caminho padrão se não houver imagem
            }
        }

        // FIM AÇÕES
    </script>
@endsection