<div>
<section class="page-header bg-primary-red text-white">
    <div class="container">
        <div class="row align-items-center min-vh-50">
            <div class="col-lg-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        @foreach($breadcrumb as $item)
                            <li class="breadcrumb-item {{ $item['activo'] ? 'active text-primary-orange' : '' }}">
                                @if($item['link'])
                                    <a href="{{ $item['link'] }}" class="text-white">{{ $item['nombre'] }}</a>
                                @else
                                    {{ $item['nombre'] }}
                                @endif
                            </li>
                        @endforeach
                    </ol>
                </nav>
                <h1 class="display-4 fw-bold mb-3 text-white">{{ $titulo }}</h1>
                <p class="lead">{{ $subtitulo }}</p>
            </div>
            <div class="col-lg-4">
                <i class="{{ $icono }} display-1 text-primary-orange"></i>
            </div>
        </div>
    </div>
</section>


</div>
