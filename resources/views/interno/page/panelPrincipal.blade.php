@extends('dashboard.app.app')
@section('page', 'Painel Principal')
@section('tittle', 'Painel Principal')

@section('contenido')
    {{-- Card --}}
    <div class="row">

        {{-- Vendas registradas --}}
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">R$ ganhos em vendas</p>
                                <h5 id="h5ventaMes" class="font-weight-bolder">R$ {{ $montoGanhos }}</h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-info shadow-info text-center rounded-circle">
                                <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Produtos Registrados --}}
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Produtos Registrados</p>
                                <h5 id="h5ventaAnio" class="font-weight-bolder">{{ $productos }}</h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Pedidos --}}
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Pedidos Solicitados</p>
                                <h5 id="h5fatura" class="font-weight-bolder">{{ $cantidadVentas }}</h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                <i class="ni ni-book-bookmark text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Clientes --}}
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Clientes</p>
                                <h5 id="h5Cliente" class="font-weight-bolder">{{ $userClientes }}</h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                <i class="ni ni-single-02 text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chartjs -->
    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card z-index-2 h-100">
                <div class="card-header pb-0 pt-3 bg-transparent">
                    <h6 class="text-capitalize">Dinheiro Acumulado em Vendas</h6>
                </div>
                <div class="card-body p-3">
                    <div class="chart">
                        <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- produtos e Fatura -->
    <div class="row mt-4">

        <!-- produtos -->
        <div class="col-lg-7 mb-lg-0 mb-4">
            <div class="card">
                <div class="card-header pb-0 p-3">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-2">Top 4 Produtos Mais Vendidos</h6>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-11">Foto</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-11 ps-2">Nome
                                </th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-11">
                                    Quantidade Vendida</th>
                            </tr>
                        </thead>
                        <tbody id="productos">
                            @foreach ($producMasVendidos as $producto)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                {{-- Accede directamente a $producto->image --}}
                                                <img src="{{ asset('storage/' . $producto->image) }}"
                                                    class="avatar avatar-sm me-3" alt="product image">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        {{-- Accede directamente a $producto->product_name --}}
                                        <p class="text-xs font-weight-bold mb-0">{{ $producto->product_name }}</p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        {{-- Accede directamente a $producto->sold_quantity --}}
                                        <span class="text-xs font-weight-bold">{{ $producto->sold_quantity }}</span>
                                    </td>
                                    {{-- Si necesitas el ID del producto, puedes usar $producto->product_id --}}
                                    {{-- <td>{{ $producto->product_id }}</td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Fatura -->
        <div class="col-lg-5">
            <div class="card">
                <div class="card-header pb-0 p-3">
                    <h6 class="mb-0">5 Maiores Vendas</h6>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-11">Código
                                    Fatura</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-11 ps-2">Valor
                                </th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-11">
                                    Data</th>
                            </tr>
                        </thead>
                        <tbody id="facturas">
                            @foreach ($mejoresVentas as $factura)
                                <tr>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $factura->stripe_payment_intent_id }}
                                        </p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">
                                            ${{ number_format($factura->total_amount, 2) }}</p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span
                                            class="text-xs font-weight-bold">{{ $factura->created_at->format('d/m/Y') }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            var rutaActual = window.location.href;

            // grafica
            $.ajax({
                url: rutaActual + '/grafica',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    grafica(data)
                },
                error: function(error) {
                    Swal.fire({
                        title: "Error",
                        text: "Error al obtener los datos de la gráfica.",
                        icon: "error",
                        confirmButtonText: "Aceptar"
                    });
                }
            });

        });

        function grafica(datos) {
            var ctx1 = document.getElementById("chart-line").getContext("2d");
            var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

            gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
            gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
            gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');

            new Chart(ctx1, {
                type: "line",
                data: {
                    labels: datos.label,
                    datasets: [{
                        label: "",
                        tension: 0.4,
                        borderWidth: 0,
                        pointRadius: 0,
                        borderColor: "#2E7305",
                        backgroundColor: gradientStroke1,
                        borderWidth: 3,
                        fill: true,
                        data: datos.data,
                        maxBarThickness: 6

                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index',
                    },
                    scales: {
                        y: {
                            grid: {
                                drawBorder: false,
                                display: true,
                                drawOnChartArea: true,
                                drawTicks: false,
                                borderDash: [5, 5]
                            },
                            ticks: {
                                display: true,
                                padding: 10,
                                color: '#0F0F0F',
                                font: {
                                    size: 11,
                                    family: "Open Sans",
                                    style: 'normal',
                                    lineHeight: 2
                                },
                            }
                        },
                        x: {
                            grid: {
                                drawBorder: false,
                                display: false,
                                drawOnChartArea: false,
                                drawTicks: false,
                                borderDash: [5, 5]
                            },
                            ticks: {
                                display: true,
                                color: '#565656',
                                padding: 20,
                                font: {
                                    size: 11,
                                    family: "Open Sans",
                                    style: 'normal',
                                    lineHeight: 2
                                },
                            }
                        },
                    },
                },
            });
        }
    </script>
@endsection
