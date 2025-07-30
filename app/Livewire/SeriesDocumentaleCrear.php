<?php

namespace App\Livewire;

use Livewire\Component;

class SeriesDocumentaleCrear extends Component
{
     public $entidad;

    public function mount($entidad)// Este metodo se ejecuta al inicializar el componente y recibe la entidad
    {
        $this->entidad = $entidad; // Asigna la entidad recibida al atributo del componente
    }
    public function render()
    {
        return view('livewire.series-documentale-crear');
    }
}
