@extends('interno.app.app')
@section('page', 'Pedidos')
@section('tittle', 'Pedidos')

@section('contenido')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 text-center">
                    <h3>Pedidos</h3>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="container mt-4">
                        <table class="table align-items-center mb-0 display responsive nowrap" cellspacing="0" id="datatable"
                            style="width: 100%">
                            <thead>
                                <tr>
                                    <th data-priority="1">Cliente</th>
                                    <th>Total Pago</th>
                                    <th>Método de Pagamento</th>
                                    <th>Status</th>
                                    <th>ID do Pagamento</th>
                                    <th>Data do Pagamento</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th data-priority="1">Cliente</th>
                                    <th>Total Pago</th>
                                    <th>Método de Pagamento</th>
                                    <th>Status</th>
                                    <th>ID do Pagamento</th>
                                    <th>Data do Pagamento</th>
                                    <th>Ações</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="modalCRUDLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content rounded-lg shadow-lg">
                {{-- Cabeçalho do Modal --}}
                <div class="modal-header rounded-t-lg" id="bg-titulo">
                    <h5 class="modal-title text-white" id="titulo">Detalhes do Pedido</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                {{-- Corpo do Modal --}}
                <div class="modal-body p-4">
                    <h5 class="fw-bold mb-3">Informações do Cliente:</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="modal-cliente-dni" class="form-label fw-bold">CPF/RG do Cliente:</label>
                            <p id="modal-cliente-dni" class="form-control-plaintext"></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="modal-cliente-nome" class="form-label fw-bold">Nome Completo:</label>
                            <p id="modal-cliente-nome" class="form-control-plaintext"></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="modal-cliente-telefono" class="form-label fw-bold">Telefone:</label>
                            <p id="modal-cliente-telefono" class="form-control-plaintext"></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="modal-cliente-email" class="form-label fw-bold">Email:</label>
                            <p id="modal-cliente-email" class="form-control-plaintext"></p>
                        </div>
                    </div>

                    <hr class="my-4">

                    <h5 class="fw-bold mb-3">Detalhes do Pagamento:</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="modal-total-pago" class="form-label fw-bold">Valor do Pagamento:</label>
                            <p id="modal-total-pago" class="form-control-plaintext"></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="modal-metodo-pago" class="form-label fw-bold">Método de Pagamento:</label>
                            <p id="modal-metodo-pago" class="form-control-plaintext"></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="modal-status" class="form-label fw-bold">Status do Pagamento:</label>
                            <p id="modal-status" class="form-control-plaintext"></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="modal-id-pago" class="form-label fw-bold">ID do Pagamento (Stripe):</label>
                            <p id="modal-id-pago" class="form-control-plaintext"></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="modal-fecha-pago" class="form-label fw-bold">Data do Pedido:</label>
                            <p id="modal-fecha-pago" class="form-control-plaintext"></p>
                        </div>
                    </div>

                    {{-- Seção de Produtos --}}
                    <hr class="my-4">
                    <h5 class="fw-bold mb-3">Produtos do Pedido:</h5>
                    <div id="modal-productos-lista" class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Produto</th>
                                    <th class="text-center">Quantidade</th>
                                    <th class="text-end">Preço Unitário</th>
                                    <th class="text-end">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Os produtos serão inseridos aqui dinamicamente -->
                            </tbody>
                        </table>
                    </div>
                    <p id="modal-no-productos" class="text-muted fst-italic text-center d-none">Não há produtos neste
                        pedido.</p>

                </div>
                {{-- Rodapé do Modal --}}
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>


@endsection



@section('scripts')
    <script>
        var token = $('meta[name="csrf-token"]').attr('content');
        var rutaAccion = "";
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
                    data: 'user.dni',
                    name: 'user.dni',
                    className: 'text-center',
                },
                {
                    data: 'total_amount',
                    name: 'total_amount',
                    className: 'text-center',
                },
                {
                    data: 'payment_method',
                    name: 'payment_method',
                    className: 'text-center',
                },
                {
                    data: 'status',
                    name: 'status',
                    className: 'text-center',
                    render: function(data, type, row) {
                        if (data === 'succeeded') {
                            return '<span class="badge bg-success">Pagamento Concluído</span>';
                        } else if (data === 'requires_payment_method') {
                            return '<span class="badge bg-danger">Método de Pagamento Necessário</span>';
                        } else if (data === 'requires_confirmation') {
                            return '<span class="badge bg-warning">Requer Confirmação</span>';
                        } else if (data === 'requires_action') {
                            return '<span class="badge bg-info">Requer Ação</span>';
                        } else if (data === 'processing') {
                            return '<span class="badge bg-secondary">Processando</span>';
                        } else if (data === 'canceled') {
                            return '<span class="badge bg-dark">Cancelado</span>';
                        } else if (data === 'requires_capture') {
                            return '<span class="badge bg-warning">Requer Captura</span>';
                        }
                        return data;
                    }
                },
                {
                    data: 'stripe_payment_intent_id',
                    name: 'stripe_payment_intent_id',
                    className: 'text-center',
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                    className: 'text-center',
                },
                {
                    "data": null,
                    "className": "align-middle text-center",
                    "render": function(data, type, row, meta) {
                        // Enlace para ver detalles, siempre visible
                        const verDetalhesLink =
                            `<li><a class="dropdown-item" data-id="${row.id}" href="javascript:ver(${row.id});"><i class="fa fa-file text-primary"></i> Ver Detalhes</a></li>`;

                        // Enlace para cancelar, visible solo si el estado NO es 'canceled'
                        const cancelarLink = (row.status !== 'canceled') ?
                            `<li><a class="dropdown-item" data-id="${row.id}" href="javascript:cancelar(${row.id});"><i class="fa fa-trash text-danger"></i> Cancelar</a></li>` :
                            ''; // Si está cancelado, no se muestra nada

                        // Retorna el HTML completo con los enlaces condicionales
                        return `
            <div class="dropdown">
                <button class="btn btn-link text-secondary mb-0" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" data-bs-placement="right">
                    <i class="fa fa-ellipsis-v text-xs"></i>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    ${verDetalhesLink}
                    ${cancelarLink}
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

        //  Consultas EndPoint
        consulta = function(id) {
            return new Promise((resolve, reject) => {
                $.ajax({
                    url: urlCompleta + "/Ver/" + id,
                    method: "GET",
                    success: function(Data) {
                        resolve(Data.datos);
                    },
                    error: function(xhr, status, error) {
                        reject(error);
                    }
                });
            });
        };

        ver = async function(id) {
            try {
                const datos = await consulta(id);

                // Título do modal: revertendo para o DNI do cliente, pois estava funcionando e é mais informativo
                $("#titulo").html("Detalhes do Pedido: " + datos.stripe_payment_intent_id || 'N/A');
                $("#titulo").attr("class", "modal-title text-white");
                $("#bg-titulo").attr("class", "modal-header bg-warning rounded-t-lg"); // Mantive a cor info

                // Preenchendo o nome completo do cliente de forma mais robusta
                let clientFullName = 'N/A';
                if (datos.user) {
                    const firstName = datos.user.name || '';
                    const lastName = datos.user.last_name || '';
                    // Combinar nome e sobrenome, e remover espaços extras se um deles estiver vazio
                    if (firstName || lastName) {
                        clientFullName = `${firstName} ${lastName}`.trim();
                    }
                }
                $('#modal-cliente-nome').text(clientFullName);

                // Preenchendo os demais campos
                $('#modal-cliente-dni').text(datos.user ? datos.user.dni : 'N/A');
                $('#modal-cliente-telefono').text(datos.user ? datos.user.phone : 'N/A');
                $('#modal-cliente-email').text(datos.user ? datos.user.email : 'N/A');
                $('#modal-total-pago').text(datos.total_amount ? `$${parseFloat(datos.total_amount).toFixed(2)}` :
                    'N/A');
                $('#modal-metodo-pago').text(datos.payment_method || 'N/A');
                $('#modal-id-pago').text(datos.stripe_payment_intent_id || 'N/A');
                $('#modal-fecha-pago').text(datos.created_at || 'N/A');

                let statusBadge = '';
                switch (datos.status) {
                    case 'succeeded':
                        statusBadge = '<span class="badge bg-success">Pagamento Concluído</span>';
                        break;
                    case 'requires_payment_method':
                        statusBadge = '<span class="badge bg-danger">Método de Pagamento Necessário</span>';
                        break;
                    case 'requires_confirmation':
                        statusBadge = '<span class="badge bg-warning">Requer Confirmação</span>';
                        break;
                    case 'requires_action':
                        statusBadge = '<span class="badge bg-info">Requer Ação</span>';
                        break;
                    case 'processing':
                        statusBadge = '<span class="badge bg-secondary">Processando</span>';
                        break;
                    case 'canceled':
                        statusBadge = '<span class="badge bg-dark">Cancelado</span>';
                        break;
                    case 'requires_capture':
                        statusBadge = '<span class="badge bg-warning">Requer Captura</span>';
                        break;
                    default:
                        statusBadge = datos.status || 'N/A';
                }
                $('#modal-status').html(statusBadge);

                const $productsTableBody = $('#modal-productos-lista tbody');
                $productsTableBody.empty();
                $('#modal-no-productos').addClass('d-none');

                if (datos.items && datos.items.length > 0) {
                    datos.items.forEach(item => {
                        const productName = item.product ? item.product.name : 'Produto Desconhecido';
                        const row = `
                        <tr>
                            <td>${productName}</td>
                            <td class="text-center">${item.quantity}</td>
                            <td class="text-end">$${parseFloat(item.unit_price).toFixed(2)}</td>
                            <td class="text-end">$${parseFloat(item.subtotal).toFixed(2)}</td>
                        </tr>
                    `;
                        $productsTableBody.append(row);
                    });
                } else {
                    $('#modal-no-productos').removeClass('d-none');
                }

                $('#modalCRUD').modal('show');
            } catch (error) {
                console.error("Erro ao visualizar o registro:", error);
                if (typeof notificacion !== 'undefined' && typeof notificacion.fire === 'function') {
                    notificacion.fire({
                        icon: "error",
                        title: "Erro!",
                        text: "Não foi possível visualizar o registro. Por favor, tente novamente."
                    });
                } else {
                    console.error(
                        "Não foi possível mostrar a notificação de erro. Verifique se SweetAlert2 ou similar está configurado."
                    );
                }
            }
        };

        cancelar = function(id) {
            // Usar SweetAlert2 para la confirmación
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esto! Se devolverá el stock de los productos.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, cancelar pedido',
                cancelButtonText: 'No, mantener'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Si el usuario confirma, realizar la solicitud AJAX
                    $.ajax({
                        url: urlCompleta + "/Cancelar/" + id,
                        method: "POST", // Usar POST según la instrucción
                        data: {
                            _token: token,
                            _method: 'DELETE' // Mas informa ao Laravel que é um DELETE
                        },
                        success: function(response) {
                            if (response.success) {
                                // Notificación de éxito y recargar la tabla
                                Swal.fire(
                                    '¡Cancelado!',
                                    'El pedido ha sido cancelado y el stock actualizado.',
                                    'success'
                                );
                                table.ajax.reload(null,
                                    false); // Recargar la tabla sin resetear la paginación
                            } else {
                                // Notificación de error si la respuesta no es exitosa
                                Swal.fire(
                                    'Error',
                                    'No se pudo cancelar el pedido. Por favor, inténtalo de nuevo.',
                                    'error'
                                );
                            }
                        },
                        error: function(xhr, status, error) {
                            // Notificación de error en caso de fallo de la solicitud
                            Swal.fire(
                                'Error de conexión',
                                'Ocurrió un error al intentar cancelar el pedido. Código de estado: ' +
                                xhr.status,
                                'error'
                            );
                        }
                    });
                }
            });
        };
    </script>
@endsection
