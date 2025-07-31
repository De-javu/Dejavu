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
        $entidad = Entities::find($entidadId);
        $series = DocumentarySeries::with('entity')->where('entity_id', $entidadId)->get(); // Filtrar series documentales por la entidad específica
    } else {
        $entidad = null;
        $series = DocumentarySeries::with('entity')->get(); // obtener todas las series documentales si no se especifica una entidad
    }

    return view('series_documentales.index', compact('series', 'entidad'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {


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
            'entity_id' => $request->entity_id, //  Este campo es obligatorio,pasarlo por que la tabla asi lo exige

        ]);

       // dd('Antes de redirigir'); // Temporal para debug

        return redirect()->route('series_documentales.index', ['entidad' => $request->entity_id])
                         ->with('success', 'serie creada con exito . ');

      }

    /**
     * Display the specified resource.
     */
    public function show(DocumentarySeries $documentarySeries, $id)
    {
        $serie = DocumentarySeries::findOrFail($id);
    // Aquí buscarás las sub-series cuando las tengas
    $subSeries = []; // Por ahora vacío

    return view('series_documentales.show', compact('serie', 'subSeries'));
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
    public function update(CrearSerieDocumental  $request,$id)
    {
        $actualizar = DocumentarySeries::find($id);
        if($actualizar){
            $actualizar->update($request->validated());
            return redirect()->route('series_documentales.index', ['entidad' => $request->entity_id])
                         ->with('success', 'serie creada con exito . ');

        }else{
              return redirect()->route('series_documentales.index',['entidad' => $request->entity_id])->with('error', 'Entidad no encontrada');
    }
    }

    /**
     * Remove the specified resource from storage.
     */
public function destroy($id)
        {
            $serie_documental = DocumentarySeries::findOrFail($id);
            $entityId = $serie_documental->entity_id; // Guarda el id antes de eliminar
            $serie_documental->delete();

            return redirect()->route('series_documentales.index', ['entidad' => $entityId])
                            ->with('success', 'Registro de serie documental eliminado');
        }
}
