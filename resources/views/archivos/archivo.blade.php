<x-layouts.app :title="__('Documentos ')">

        <!-- Titulo -->
 <div class=" my-4 w-full space-y-4 flex  flex-col items-center  ">
    <h1 class="text-3xl font-bold text-left" >
        {{('Lista de Documentos')}}
    </h1>
             <!-- Formulario de busqueda -->
            <form action="{{ route('archivos', ['type' => $originalType])}}"
             method="get" class="flex flex-col">
             <label class="text-center text-md mb-4" for="buscar">Buscar por nombre del documento</label>
             <div>
                <input
                    type="text"
                    name="buscar"
                    placeholder="Buscar ..."
                    value="{{ request('buscar') }}"
                    class="border border-gray-300 rounded-lg py-2 px-4 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                <button
                    type="submit"
                    class="ml-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Buscar
                </button>
            </div>
            </form>
</div>

   <!-- Mostrar mensajes de exito en el busqueda-->

@if($buscar)
      @if($conArchivos)
          <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative text-center mb-4" role="alert">
            {{__('Se encontraron resultados para: ')}} "{{$buscar}}"
          </div>
      @else
          <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative text-center mb-4" role="alert">
            {{ __('No se encontraron resultados para: ')}} "{{$buscar}}" . {{__('Intenta con otra consulta')}}
          </div>
      @endif
@endif

<hr>
<!-- tabla que lista los datos de los documentos  -->
<div class="overflow-x-auto mt-6">
    <table class= "min-w-full dark:bg-gray-900 shadow-md rounded-lg overflow-hidden">
        <thead class= "dark:bg-gray-700">
            <tr>
                <th class="py-3 px-6  text-center text-sm">Accion</th>
                <th class="py-3 px-6  text-left text-sm">Entidad</th>
                <th class="py-3 px-6 text-left text-sm">Serie Documental</th>
                <th class="py-3 px-6 text-left text-sm">Sub Serie Documental</th>
                <th class="py-3 px-6 text-left text-sm">Nombre Original Del Documento</th>
                <th class="py-3 px-6 text-left text-sm">Nombre de carga</th>
                <th class="py-3 px-6 text-left text-sm">Extencion </th>
                <th class="py-3 px-6 text-left text-sm">Fecha Inicial</th>
                <th class="py-3 px-6 text-center text-sm">Fecha Final</th>
                <th class="py-3 px-6 text-left text-sm">Codigo Hash</th>
                <th class="py-3 px-6 text-left text-sm">Folios</th>
                <th class="py-3 px-6 text-left text-sm">Codio TRD</th>
                <th class="py-3 px-6 text-left text-sm">Años De Retencion</th>
                <th class="py-3 px-6 text-left text-sm">Disposicion Final</th>
                <th class="py-3 px-6 text-left text-sm">Notas</th>
                <th class="py-3 px-6 text-left text-sm">Feacha de Creacion</th>
            </tr>
        </thead>

        <!-- Contenido dinamico de la tabla  -->
        <tbody class="bg-white dark:bg-gray-800 ">
            @foreach ($archivos As $documento)
            <tr class="border-1 border-dark-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 ">

 <td class="py-3 px-6 text-center" >
            <div class="flex gap-2">
               {{-- Boton editar --}}
            <flux:modal.trigger name="editar-entidad-{{}}">
                <flux:button variant="primary" color="yellow" size="sm" class="px-2 py-1 group ">
                <flux:icon.pencil class="w-4 h-4" />
                  <span
                    class="absolute left-1/2 -translate-x-1/2 bottom-full mb-2 w-max px-2 py-1 bg-gray-800 text-white text-xs rounded opacity-0 group-hover:opacity-100 transition pointer-events-none z-100">
                    Editar
                  </span>
                </flux:button>
            </flux:modal.trigger>
              {{-- Series Documental --}}

                <flux:button variant="primary"

                 color="blue" size="sm" class="px-2 py-1 group "
                 onclick="window.open()">
                <flux:icon.folder class="w-4 h-4" />
                 <span
                    class="absolute left-1/2 -translate-x-1/2 bottom-full mb-2 w-max px-2 py-1 bg-gray-800 text-white text-xs rounded opacity-0 group-hover:opacity-100 transition pointer-events-none z-100">
                     ver
                  </span>
                </flux:button>

                    {{-- Boton eliminar --}}
              <flux:modal.trigger name="delete-{{}}">
             <flux:button variant="danger" size="sm" class="px-2 py-1 flex items-center gap-1 group">
                <flux:icon.trash-2 class="w-4 h-4" />
                 <span
                    class="absolute left-1/2 -translate-x-1/2 bottom-full mb-2 w-max px-2 py-1 bg-gray-800 text-white text-xs rounded opacity-0 group-hover:opacity-100 transition pointer-events-none z-100">
                    Descargar informacion
                  </span>
                </flux:button>
            </flux:modal.trigger>
                </td>

                <td class="py-3 px-6 text-center">{{ $documento->entity->name}}</td>
                <td class="py-3 px-6 text-center">{{ $documento->documentarySerie?->name }}</td>
                <td class="py-3 px-6 text-center">{{ $documento->parentSeries?->name }}</td>
                <td class="py-3 px-6 text-left">{{ $documento->original_name}}</td>
                <td class="py-3 px-6 text-center">{{ $documento->display_name}}</td>
                <td class="py-3 px-6 text-center">{{ $documento->extension}}</td>
                <td class="py-3 px-6 text-center">{{ $documento->start_date}}</td>
                <td class="py-3 px-6 text-center">{{ $documento->end_date}}</td>
                <td class="py-3 px-6 text-center">{{ $documento->hash_code}}</td>
                <td class="py-3 px-6 text-center">{{ $documento->folio}}</td>
                <td class="py-3 px-6 text-center">{{ $documento->trd_code}}</td>
                <td class="py-3 px-6 text-center">{{ $documento->central_retention_years}}</td>
                <td class="py-3 px-6 text-center">{{ $documento->final_disposition}}</td>
                <td class="py-3 px-6 text-center">{{ $documento->retenction_notes}}</td>
                <td class="py-3 px-6 text-center">{{ $documento->created_at}}</td>








            </tr>
            @endforeach
        </tbody>
    </table>

</div>

                <!-- Paginación -->
{{ $archivos->appends(request()->query())->links() }}

</x-layouts.app>
