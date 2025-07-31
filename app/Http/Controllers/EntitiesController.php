<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEntitiesRequest;
use App\Models\Entities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Actions\ReturnPaginationView;

class EntitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $entidades = Entities::with('user')->get(); // obtener todas las entidades con la relación de usuario
       return view('entidades.index', compact('entidades')); // Pasar las entidades a la vista
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //return view('entidades.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store( CreateEntitiesRequest $request)
    {

        Entities::create([ // Crear una nueva entidad con los datos validados
            'name' => $request->name,
            'user_id' => Auth::id(),
            'entity' => $request->entity,
            'administrative_unit' => $request->administrative_unit,  // ← NUEVO CAMPO
            'producer_office' => $request->producer_office,         // ← NUEVO CAMPO


        ]);



        return redirect()->route('entidades.index')->with('success', 'Entidad creada exitosamente.');
    }


    /**
     * Display the specified resource.
     */
    public function show(entities $entities)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(entities $entities)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update( CreateEntitiesRequest $request, $id)
    {
        $entidad = Entities::find($id); // Buscar la entidad por ID, para la actualizacion

        if($entidad) { // Verificar si la entidad existe, se ejecuta la actualizacion
                $entidad->update([ // Actualizar los datos de la entidad
                'name' => $request->name,
                'entity' => $request->entity,
                'administrative_unit' => $request->administrative_unit,
                'producer_office' => $request->producer_office,
            ]);

            return redirect()->route('entidades.index')->with('success', 'Entidad actualizada exitosamente'); // Redireccionar a la lista de entidades con un mensaje de éxito

        }
        else{
            return redirect()->route('entidades.index')->with('error', 'Entidad no encontrada'); // Redireccionar a la lista de entidades con un mensaje de error
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $entidad = Entities::findOrFail($id); // Buscar la entidad por ID, si no existe lanzará una excepción

        $entidad->delete();

        return redirect()->route('entidades.index')->with('succes', 'Registro de identidad eliminado');


    }
}
