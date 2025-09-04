<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class PageHeader extends Component
{
    public $titulo;
    public $subtitulo;
    public $icono;
    public $breadcrumb;

    /**
     * Create a new component instance.
     *
     * @param string $titulo
     * @param string $subtitulo
     * @param string $icono
     * @param array $breadcrumb
     */
    public function __construct($titulo, $subtitulo, $icono, $breadcrumb = [])
    {
        $this->titulo = $titulo;
        $this->subtitulo = $subtitulo;
        $this->icono = $icono;
        $this->breadcrumb = $breadcrumb;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.page-header');
    }
}