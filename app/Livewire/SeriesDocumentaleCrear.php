<?php

namespace App\Livewire;

use Livewire\Component;

class SeriesDocumentaleCrear extends Component
{
        public $editar = false;
        public $serie;
        public $name;
        public $entidad;


   public function mount($entidad, $serie = null)// Método que se ejecuta al montar el componente
{
    $this->entidad = $entidad;  // Recibe la entidad desde el controlador
    $this->serie = $serie; // Recibe la serie desde el controlador si se está editando

    // Si se está editando, asigna los valores de la serie a las propiedades del componente
    if ($serie) {
        $this->editar = true; // Indica que se está editando
        $this->name = $serie->name; // Asigna el nombre de la serie a la propiedad del componente
    }
}

    public function render()
    {
        return view('livewire.series-documentale-crear');
    }
}


