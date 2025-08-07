<?php

namespace App\Http\Controllers;

use App\Http\Requests\CrearSerieDocumental;
use App\Http\Requests\CrearSubSeries;
use Illuminate\Support\Facades\App;
use App\Models\Entities;
use App\Models\DocumentarySeries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DocumentarySeriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */

public function index(Request $request)
{

    $entidadId = $request->query('entidad'); // Esto es lo que llega del formualario, se debe capturasr asi para optener todos los datos

    if ($entidadId) {
        $entidad = Entities::find($entidadId);                // Buscar la entidad por su ID, para conevrtir en objeto
        $series = DocumentarySeries::with('entity')   // Cargar la entidad relacionada
        ->where('entity_id', $entidadId)      // Filtrar por entidad
        ->whereNull('parent_series_id')               // Solo series principales,que su padre es null
        ->get();                                              // Filtrar series documentales por la entidad específica
    } else {
        $entidad = null;
        $series = DocumentarySeries::with('entity')
        ->whereNull('parent_series_id')
        ->get(); // obtener todas las series documentales si no se especifica una entidad
    }

    return view('series_documentales.index', compact('series', 'entidad'));
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

      //dd('Antes de redirigir'); // Temporal para debug

        return redirect()->route('series_documentales.index', ['entidad' => $request->entity_id])
                         ->with('success', 'serie creada con exito . ');

      }

    /**
     * Display the specified resource.
     */

    public function show($id)  // ← Solo recibe el ID
    {
    $serie = DocumentarySeries::with('entity', 'children', 'user', )->findOrFail($id); // Cargar la entidad y las subseries relacionadas

    $entidad = $serie->entity; // Obtener la entidad asociada a la serie documental
    $subSeries = $serie->children; // Obtener las sub-series asociadas a la serie documental accede por medio del modelo
    $usuario = $serie->user;

    return view('series_documentales.show', compact('serie', 'subSeries', 'entidad', 'usuario'));
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
                         ->with('success', 'serie actualizada con exito . ');

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
            $hija = $serie_documental->parent_series_id;

            if($hija) {
                     $serie_documental->delete();
                     return redirect()->route('series_documentales.show', ['series_documentale' => $hija,])
                            ->with('success', 'Registro de serie documental eliminado');

                } else {
                     $serie_documental->delete();
                         return redirect()->route('series_documentales.index', ['entidad' => $entityId])
                                ->with('success', 'Registro de serie documental eliminado');
    }
}


    public function  sub_carpeta(CrearSubSeries  $request, $serie)
        {

             //dd('Datos recibidos:', $request->all());

    DocumentarySeries::create([
        'name' => $request->name,
        'user_id' => Auth::id(),
        'entity_id' => $request->entity_id, // Viene del campo oculto
        'parent_series_id' => $serie // Este es el ID de la serie padre
    ]);

    return redirect()->route('series_documentales.show',  ['series_documentale' => $serie])
                     ->with('success', 'Sub serie creada con éxito.');


      }

      public function sub_editar(CrearSubSeries $request, $id)
      {
        $actualizar = DocumentarySeries::find($id);

        if($actualizar)
                    {
                     $actualizar->update($request->validated());
                      return redirect()->route('series_documentales.show',  ['series_documentale' => $actualizar->parent_series_id])
                     ->with('success', 'Sub serie editada con éxito.');

                    }else{

                           return redirect()->route('series_documentales.show',  ['series_documentale' => $actualizar->parent_series_id])
                                 ->with('success', 'no fue posible actualizar.');

                         }

      }

}


