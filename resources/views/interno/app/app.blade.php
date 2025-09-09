<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/logo2.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/logo2.png') }}">
    <link rel="shortcut icon" href="{{ asset('images/logo2.png') }}" type="image/x-icon">

    {{-- seo --}}
    <meta name="description"
        content="Compre ingredientes de alta qualidade e descubra receitas deliciosas na VeDistribuidora. Sua loja online de confiança para os amantes da culinária brasileira. Entregamos para todo o Brasil.">
    <meta name="keywords"
        content="VeDistribuidora, loja online de alimentos, ingredientes para receitas, culinária brasileira, receitas fáceis, doces, salgados, produtos de qualidade, entrega no Brasil">
    <meta name="author" content="VeDistribuidora">

    <meta property="og:title" content="VeDistribuidora - Ingredientes de qualidade e receitas deliciosas">
    <meta property="og:description"
        content="Sua loja online completa para comprar ingredientes e encontrar as melhores receitas brasileiras. Siga-nos no Instagram para mais inspirações!">
    <meta property="og:image" content="{{ asset('images/logo2.png') }}">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:type" content="website">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="VeDistribuidora - Tu tienda de confianza">
    <meta name="twitter:description" content="Compra productos de calidad en VeDistribuidora.">
    <meta name="twitter:image" content="{{ asset('images/logo2.png') }}">
    <meta name="twitter:site" content="@VeDistribuidora">
    <meta name="twitter:creator" content="@VeDistribuidora">

    <title>
        @include('interno.app.nombre') || @yield('tittle')
    </title>

    <!-- Fonts and icons -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

    <!-- Nucleo Icons -->
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />


    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.css?v=2.0.4') }}" rel="stylesheet" />

    <!-- Font Awesome Icons -->
    <script src="{{ asset('assets/icon/icon.js') }}" crossorigin="anonymous"></script>

    {{-- Jquery --}}
    <script src="{{ asset('assets/js/plugins/jquery3.js') }}"></script>

    {{-- sweetalert2 --}}
    <script src="{{ asset('assets/js/plugins/sweetalert2.js') }}"></script>

    {{-- Select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    {{-- RELS --}}
    <link href="https://cdn.datatables.net/2.1.0/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.bootstrap5.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/2.1.0/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.0/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.bootstrap5.js"></script>

</head>

<body class="g-sidenav-show   bg-gray-100">

    <!-- Background -->
    <div class="min-height-300 bg-warning position-absolute w-100"></div>

    <aside
        class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
        id="sidenav-main">
        <!-- Sidenav-->
        @include('interno.app.sidenav')

        <hr class="horizontal dark mt-0">

        {{-- Menu --}}
        @include('interno.app.navbar')

    </aside>

    <main class="main-content position-relative border-radius-lg ">
        <!-- Navbar -->
        @include('interno.app.nav')

        <!-- End Navbar -->
        <div class="container-fluid py-4">

            @yield('contenido')

            <!-- Footer -->
            @include('interno.app.footer')
        </div>
    </main>

    {{-- NoTocar --}}
    <div class="fixed-plugin">
        <div class="card shadow-lg">
            <div class="card-body pt-sm-3 pt-0 overflow-auto">
                <div class="d-flex">
                    <button class="btn bg-gradient-primary w-100 px-3 mb-2 active me-2" data-class="bg-white"
                        onclick="sidebarType(this)">White</button>
                </div>
            </div>
        </div>
    </div>

    <!--   Core JS Files   -->
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>
    <script src="{{ asset('assets/js/argon-dashboard.min.js?v=2.0.4') }}"></script>

    <script>
        // Notificaciones
        const notificacion = Swal.mixin({
            toast: true,
            position: "bottom-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
    </script>
    @yield('scripts')
</body>

</html>
