<?php

namespace App\Livewire;

use Livewire\Component;

class SubSeries extends Component
{
    public $serie; // Variable para almacenar la serie recibida
    public $name;
    public $entidad;

    public function mount($serie, $entidad) // Método que se ejecuta al montar el componente
    {
        $this->serie = $serie;
        $this->entidad = $entidad; // ← Asigna la entidad
    }
    public function render()
    {
        return view('livewire.sub-series');
    }
}
