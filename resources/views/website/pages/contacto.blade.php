@extends('website.layouts.app')
@section('subtitulo', 'Contacto')
@section('descripcion', 'Estamos aquí para ayudarte. Contáctanos para más información sobre nuestros cursos.')
@section('keywords', 'contacto, información, cursos, ayuda, soporte, academia CADI, preguntas frecuentes')

@section('content')
    <x-page-header titulo="Contacto"
        subtitulo="Estamos aquí para ayudarte. Contáctanos para más información sobre nuestros cursos."
        icono="fas fa-envelope" :breadcrumb="[
            ['nombre' => 'Inicio', 'link' => 'index.html', 'activo' => false],
            ['nombre' => 'Contacto', 'link' => null, 'activo' => true],
        ]" />

    @include('website.components.contacto')
    @include('website.components.googlemaps')
@endsection

@section('scripts')
@endsection
