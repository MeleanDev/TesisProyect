<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instituto CADI - @yield('subtitulo')</title>
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

    @include('website.components.verificarCertificado')

    @yield('scripts')
    <script>
        $(document).ready(function() {

            // --- NUEVO CÓDIGO AÑADIDO ---
            // Formatear el input del código del certificado en tiempo real
            $('#codigo_certificado_input').on('input', function() {
                let valor = $(this).val();

                // 1. Reemplaza todos los espacios con un guion (-)
                valor = valor.replace(/ /g, '-');

                // 2. Elimina cualquier caracter que NO sea letra, número o guion
                valor = valor.replace(/[^a-zA-Z0-9-]/g, '');

                // 3. (Opcional) Convierte todo a mayúsculas para consistencia
                valor = valor.toUpperCase();

                // 4. Actualiza el valor del input
                $(this).val(valor);
            });
            // --- FIN DEL CÓDIGO AÑADIDO ---


            // Cuando se envía el formulario del modal
            $('#formVerificarCertificado').on('submit', function(event) {
                event.preventDefault(); // Evita que la página se recargue

                let codigo = $('#codigo_certificado_input').val();
                let button = $('#btnVerificarCertificado');
                let btnText = $('#btn-text');
                let btnSpinner = $('#btn-spinner');
                let errorMessage = $('#verificar-error-message');

                // Mostrar spinner y deshabilitar botón
                btnText.hide();
                btnSpinner.show();
                button.prop('disabled', true);
                errorMessage.text(''); // Limpiar errores previos

                // Petición AJAX al backend
                $.ajax({
                    url: "{{ route('certificado.verificar') }}",
                    type: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        codigo: codigo
                    },
                    success: function(response) {
                        // Si el certificado es válido
                        if (response.success) {
                            // Abrir el PDF en una nueva pestaña
                            window.open(response.url, '_blank');
                            // Cerrar el modal
                            $('#modalVerificarCertificado').modal('hide');
                            // Limpiar el input
                            $('#codigo_certificado_input').val('');
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        // Si el certificado no se encuentra (error 404)
                        if (jqXHR.status == 404) {
                            errorMessage.text(
                                'Código de certificado no válido o no encontrado.');
                        } else {
                            // Para cualquier otro error
                            errorMessage.text('Ocurrió un error. Inténtalo de nuevo.');
                        }
                    },
                    complete: function() {
                        // Ocultar spinner y habilitar botón
                        btnSpinner.hide();
                        btnText.show();
                        button.prop('disabled', false);
                    }
                });
            });

            // Limpiar el mensaje de error cuando se cierra el modal
            $('#modalVerificarCertificado').on('hidden.bs.modal', function() {
                $('#verificar-error-message').text('');
                $('#codigo_certificado_input').val('');
            });
        });
    </script>
</body>

</html>
