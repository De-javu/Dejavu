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
    // Caché simple de 30 minutos para evitar cargar la estructura cada vez, que se ingrese
   $estructura = Cache::remember('estructura_dashboard', 1800, function () {
       return Entities::with(['documentarySeries.children'])->get();
   });

    return view('dashboard', compact('estructura'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Se encarga de procesar y almacenar los archivos subidos.
     */

public function store(CargarArchivoRequest $request)
{
    // Se crean los arrays para almacenar resultados procesamiento
    $archivosGuardados = [];
    $archivosError = [];

    // Se recorren los archivos cargados el formulario que pasaron el validation
    foreach ($request->file('archivo') as $file) {

        // filtra archivos corructos o dañados o no existentes para que no los procese el forech, continua con el siguiente
        if (!$file || !$file->isValid()) {
            continue;
        }

        // Se encarga de validar y procesar si tenemos errore, lo captura en el catch sin romper el foreach
        try {
            // Optiene el nombre original del archivo
            $nombreArchivo = $file->getClientOriginalName();

            // 4. CALCULAR hash SHA-256 para detectar duplicados
            $hash = hash_file('sha256', $file->getPathname());

            // Revisar si exoiste duplicados en la atributos hash_code
            $duplicado = UploadFile::where('hash_code', $hash)->first();
                        if ($duplicado) {
                            $archivosError[] = "❌ Archivo duplicado: {$nombreArchivo}";
                            continue;
}

            // Obtener el nombre original del archivo
            $nombreArchivo = $file->getClientOriginalName();

            //Se instancia el modelo UploadFile para guardar los metadatos
            $archivo = new UploadFile();
            $archivo->user_id = Auth::id();
            $archivo->documentary_series_id = $request->serie_id;
            $archivo->parent_series_id = $request->subserie_id;
            $archivo->entity_id = $request->entidad_id;
            $archivo->original_name = $nombreArchivo;
            $archivo->display_name = $request->name;
            $archivo->extension = $file->getClientOriginalExtension();
            $archivo->mime_type = $file->getClientMimeType();
            $archivo->folio = $request->folio ?? null;
            $archivo->size = $file->getSize();
            $archivo->start_date = $request->start_date;
            $archivo->end_date = $request->end_date;
            $archivo->hash_code = $hash;
            $archivo->trd_code = $request->trd_code;
            $archivo->central_retention_years = $request->central_retention_years;
            $archivo->final_disposition = $request->final_disposition;
            $archivo->retention_notes = $request->retention_notes;

            // 5. Alamacenar archivo en estructura jerárquica
            $rutaCarpeta = "entidad_{$request->entidad_id}/serie_{$request->serie_id}/subserie_{$request->subserie_id}";
            $path = $file->store($rutaCarpeta, 'uploads');
            $archivo->path = $path;

            // 6. Almacenar en base de datos

            $archivo->save();


            // 7. Registrar en el array de archivos guardados para mostrar al usuario
            $archivosGuardados[] = [
                'nombre' => $archivo->original_name,
                'url' => asset('storage/uploads/' . $path),
            ];

            // 8. Pausa entre archivos para no sobrecargar
            usleep(200000); // 0.2 segundos


           // Log para depuración
        } catch (\Exception $e) {
            $archivosError[] = "❌ " . $nombreArchivo . ": " . $e->getMessage();
            continue; // Pasa al siguiente archivo
        }
    }



    // Return Despues del foreach que envia a la vista dashboard los resultados
    return redirect()->route('dashboard')->with([
        'success' => 'Procesamiento completado',
        'archivos_guardados' => $archivosGuardados,
        'archivos_error' => $archivosError
    ]);
}
    /**
     * Display the specified resource.
     */
    public function show(Request $request, $type)
    {
        $buscar = $request->input('buscar');
        $originalType = $type; // Conservar el tipo original para la URL

        $archivos = UploadFile::with('documentarySerie','parentSeries')
                              ->whereRAW('LOWER(extension) = ?', [$type])
                              ->when($buscar, function($query,$buscar){
                        $query->where('original_name', 'like', "%{$buscar}%")
                               ->orwhere('display_name', 'like', "%{$buscar}%");

                            })



                              ->orderBy('id')
                              ->paginate(5);

              $conArchivos = $archivos->count() > 0;

        if (in_array($type, ['pdf'])) {
                 $type ='archivo';
        }elseif (in_array($type, ['mp3'])) {
                 $type = 'audio';
        }elseif (in_array($type, ['mp4'])) {
                 $type = 'video';
        }elseif (in_array($type, ['jpg','jpeg','tiff','tif'])) {
                 $type = 'imagen';
        }


         return view("archivos.$type", compact('archivos', 'buscar', 'originalType', 'conArchivos'));

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
