<?php

namespace App\Http\Controllers;

use App\Http\Requests\CrearSerieDocumental;
use Illuminate\Support\Facades\App;
use App\Models\Entities;
use App\Models\DocumentarySeries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocumentarySeriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */

public function index(Request $request)
{

    $entidadId = $request->query('entidad'); // Esto es lo que llega del formualario, se debe capturasr asi pata optener tods los datos

    if ($entidadId) {
        // Obtener la entidad completa
        $entidad = Entities::find($entidadId);

        // Filtrar series documentales por la entidad específica
        $series = DocumentarySeries::with('entity')->where('entity_id', $entidadId)->get();
    } else {
        $entidad = null;
        $series = DocumentarySeries::with('entity')->get(); // obtener todas las series documentales si no se especifica una entidad
    }

    return view('series_documentales.index', compact('series', 'entidad')); // retorna la vista con las series documentales y la entidad
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CrearSerieDocumental  $request)
    {


        //dd('Datos recibidos:', $request->all()); // Debug: Verifica los datos recibidos

     DocumentarySeries::create([ // Crear una nueva entidad con los datos validados
            'name' => $request->name,
            'user_id' => Auth::id(), // Asignar el ID del usuario autenticado
            'entity_id' => $request->entity_id, // ← Este campo es obligatorio

        ]);

       // dd('Antes de redirigir'); // Temporal para debug

        return redirect()->route('series_documentales.index', ['entidad' => $request->entity_id])
            ->with('success', 'serie creada con exito . ');

      }

    /**
     * Display the specified resource.
     */
    public function show(DocumentarySeries $documentarySeries)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DocumentarySeries $documentarySeries)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DocumentarySeries $documentarySeries)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DocumentarySeries $documentarySeries)
    {
        //
    }
}
