<?php

namespace App\Livewire;

use Livewire\Component;

class CargarArchivosComponent extends Component
{

public $estructura;
public $entidad_id;
public $serie_id;
public $subserie_id;
public $mostrarExtras = false ;
public $entidadSeleccionada;


public function mount($estructura)
{
    $this->estructura = $estructura;
}


    public function render()
    {
        return view('livewire.cargar-archivos-component');
    }
}
