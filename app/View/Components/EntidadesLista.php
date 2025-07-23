<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EntidadesLista extends Component
{
    /**
     * Create a new component instance.
     */
    public $entidades;
    public function __construct($entidades)
    {
        $this->entidades = $entidades;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.entidades-lista');
    }
}
