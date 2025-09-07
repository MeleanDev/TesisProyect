<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academia CADI - @yield('subtitulo')</title>
    <meta name="description" content="@yield('descripcion')">
    <meta name="keywords" content="@yield('keywords')">
    <meta name="author" content="Academia CADI">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Boostrastp --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Fontawesome --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    {{-- Select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{ asset('estilos/website/css/styles.css') }}">
    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('estilos/website/img/logo.png') }}" type="image/x-icon">

    {{-- script --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('estilos/website/js/script.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
@yield('styles')
<body>
    <!-- Header -->
    @include('website.layouts.header')

    <!-- Main Content -->
    @yield('content')

    <!-- Footer -->
    @include('website.layouts.footer')

    <!-- WhatsApp Button -->
    @include('website.components.whatsappButton')

    <!-- Login Modal -->
    @include('website.components.modalLogin')

    @yield('scripts')
</body>

</html>
