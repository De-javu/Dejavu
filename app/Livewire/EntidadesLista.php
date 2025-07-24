<?php

namespace App\Livewire;

use Livewire\Component;

class EntidadesLista extends Component
{
    public $modalAbierto = false;
    public $entidades;

    public function mount($entidades)
    {
        // Recibe las entidades desde el controlador
        $this->entidades = $entidades;
    }

    public function abrirModal()
    {
        $this->modalAbierto = true;
    }

    public function cerrarModal()
    {
        $this->modalAbierto = false;
    }

    public function render()
    {
        return view('livewire.entidades-lista');
    }
}
