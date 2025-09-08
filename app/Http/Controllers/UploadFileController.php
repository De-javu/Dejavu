<?php

namespace App\Http\Controllers;

use App\Http\Requests\CargarArchivoRequest;
use App\Models\DocumentarySeries;
use App\Models\Entities;
use App\Models\UploadFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class UploadFileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  public function index()
{
    // Caché simple de 30 minutos para evitar cargar la estructura cada vez
   // $estructura = Cache::remember('estructura_dashboard', 1800, function () {
    //    return Entities::with(['documentarySeries.children'])->get();
   // });

    //return view('dashboard', compact('estructura'));
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

// public function store(CargarArchivoRequest $request)
// {
//     $archivosGuardados = [];
//     $archivosError = [];

//     foreach ($request->file('archivo') as $file) {
//         if (!$file || !$file->isValid()) {
//             continue;
//         }

//         try {
//             // 1. VERIFICACIÓN TEMPRANA por nombre/tamaño (más rápido)
//             $nombreArchivo = $file->getClientOriginalName();
//             $tamanoArchivo = $file->getSize();

//             $duplicadoRapido = UploadFile::where('original_name', $nombreArchivo)
//                 ->where('size', $tamanoArchivo)
//                 ->where('parent_series_id', $request->subserie_id)
//                 ->first();

//             if ($duplicadoRapido) {
//                 $archivosError[] = "Archivo duplicado: {$nombreArchivo}";
//                 continue;
//             }

//        // Usa un hash temporal simple:
// $hash = 'temp_' . uniqid() . '_' . time();

//             // 3. VERIFICACIÓN FINAL por hash
//             if (UploadFile::where('hash_code', $hash)->exists()) {
//                 $archivosError[] = "Archivo duplicado (mismo contenido): {$nombreArchivo}";
//                 continue;
//             }

//             // 4. USAR TRANSACCIÓN para consistencia
//             DB::transaction(function() use ($file, $request, &$archivosGuardados, $hash, $nombreArchivo) {

//                 $archivo = new UploadFile();
//                 $archivo->user_id = Auth::id();
//                 $archivo->documentary_series_id = $request->serie_id;
//                 $archivo->parent_series_id = $request->subserie_id;
//                 $archivo->entity_id = $request->entidad_id;
//                 $archivo->original_name = $nombreArchivo;
//                 $archivo->display_name = $request->name;
//                 $archivo->extension = $file->getClientOriginalExtension();
//                 $archivo->mime_type = $file->getClientMimeType();
//                 $archivo->folio = $request->folio ?? 0;
//                 $archivo->size = $file->getSize();
//                 $archivo->start_date = $request->start_date;
//                 $archivo->end_date = $request->end_date;
//                 $archivo->hash_code = $hash;
//                 $archivo->trd_code = $request->trd_code;
//                 $archivo->central_retention_years = $request->central_retention_years;
//                 $archivo->final_disposition = $request->final_disposition;
//                 $archivo->retention_notes = $request->retention_notes;

//                 // 5. ALMACENAR archivo en estructura jerárquica
//                 $rutaCarpeta = "entidad_{$request->entidad_id}/serie_{$request->serie_id}/subserie_{$request->subserie_id}";
//                 $path = $file->store($rutaCarpeta, 'uploads');
//                 $archivo->path = $path;

//                 // 6. GUARDAR en base de datos
//                 $archivo->save();

//                 $archivosGuardados[] = [
//                     'nombre' => $archivo->original_name,
//                     'url' => asset('storage/uploads/' . $path),
//                 ];

//                 // 7. LIBERAR memoria explícitamente
//                 unset($archivo);
//             });

//             // 8. PAUSA entre archivos para no sobrecargar
//             usleep(200000); // 0.2 segundos

//         } catch (\Exception $e) {
//             $archivosError[] = "Error procesando {$nombreArchivo}: " . $e->getMessage();
//             continue;
//         }
//     }

//     // 9. RESPUESTA con información completa
//     $mensaje = 'Proceso completado.';
//     if (count($archivosGuardados) > 0) {
//         $mensaje .= ' ' . count($archivosGuardados) . ' archivo(s) guardado(s).';
//     }
//     if (count($archivosError) > 0) {
//         $mensaje .= ' ' . count($archivosError) . ' archivo(s) con problemas.';
//     }

//     return redirect()->route('dashboard')->with([
//         'success' => $mensaje,
//         'archivos_guardados' => $archivosGuardados,
//         'archivos_error' => $archivosError
//     ]);
// }

    /**
     * Display the specified resource.
     */
    public function show(UploadFile $uploadFile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UploadFile $uploadFile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UploadFile $uploadFile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UploadFile $uploadFile)
    {
        //
    }
}
