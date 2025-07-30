<?php

namespace App\Livewire;

use Livewire\Component;

class EntidadesLista extends Component
{
    public $modalAbierto = false;
    public $entidades;



    public function mount($entidades)// Metodo que se ejecuta al montar el componente
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

    public function render() // Método que renderiza la vista del componente
    {
        return view('livewire.entidades-lista');
    }
}
