<x-layouts.app :title="__('Vedeos ')">
 <div class=" my-6 w-full space-y-6">
    <h1 class="text-3xl font-bold text-center" >
        {{('Lista de Video')}}
    </h1>
</div>
<div class="overflow-x-auto">
    <table class= "min-w-full dark:bg-gray-900 shadow-md rounded-lg overflow-hidden">
        <thead class= "dark:bg-gray-700">
            <tr>
                <th class="py-3 px-6  text-left text-sm">Entidad</th>
                <th class="py-3 px-6 text-left text-sm">Serie Documental</th>
                <th class="py-3 px-6 text-left text-sm">Sub Serie Documental</th>
                <th class="py-3 px-6 text-left text-sm">Nombre Original Del Documento</th>
                <th class="py-3 px-6 text-left text-sm">Extencion </th>
                <th class="py-3 px-6 text-left text-sm">Fecha Inicial</th>
                <th class="py-3 px-6 text-center text-sm">Fecha Final</th>
                <th class="py-3 px-6 text-left text-sm">Codigo Hash</th>
                <th class="py-3 px-6 text-left text-sm">Codio TRD</th>
                <th class="py-3 px-6 text-left text-sm">Años De Retencion</th>
                <th class="py-3 px-6 text-left text-sm">Disposicion Final</th>
                <th class="py-3 px-6 text-left text-sm">Notas</th>
                <th class="py-3 px-6 text-left text-sm">Feacha de Creacion</th>
                 <th class="text-center px-4 py-4 ">Accion</th>
            </tr>
        </thead>
        <tbody class="bg-white dark:bg-gray-800 ">
            @foreach ($archivos As $documento)
            <tr class="border-1 border-dark-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 ">
                <td class="py-3 px-6 text-center">{{ $documento->entity->name}}</td>
                <td class="py-3 px-6 text-center">{{ $documento->documentarySerie?->name }}</td>
                <td class="py-3 px-6 text-center">{{ $documento->parentSeries?->name }}</td>
                <td class="py-3 px-6 text-left">{{ $documento->original_name}}</td>
                <td class="py-3 px-6 text-center">{{ $documento->extension}}</td>
                <td class="py-3 px-6 text-center">{{ $documento->start_date}}</td>
                <td class="py-3 px-6 text-center">{{ $documento->end_date}}</td>
                <td class="py-3 px-6 text-center">{{ $documento->hash_code}}</td>
                <td class="py-3 px-6 text-center">{{ $documento->trd_code}}</td>
                <td class="py-3 px-6 text-center">{{ $documento->central_retention_years}}</td>
                <td class="py-3 px-6 text-center">{{ $documento->final_disposition}}</td>
                <td class="py-3 px-6 text-center">{{ $documento->retenction_notes}}</td>
                <td class="py-3 px-6 text-center">{{ $documento->created_at}}</td>
                <td >
            <div class="flex gap-2">
               {{-- Boton editar --}}
            <flux:modal.trigger name="editar-entidad-{{}}">
                <flux:button variant="primary" color="yellow" size="sm" class="px-2 py-1 group ">
                <flux:icon.pencil class="w-4 h-4" />
                  <span
                    class="absolute left-1/2 -translate-x-1/2 bottom-full mb-2 w-max px-2 py-1 bg-gray-800 text-white text-xs rounded opacity-0 group-hover:opacity-100 transition pointer-events-none z-100">
                    Editar entidad
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
                     Serie Documental
                  </span>
                </flux:button>

                    {{-- Boton eliminar --}}
              <flux:modal.trigger name="delete-{{}}">
             <flux:button variant="danger" size="sm" class="px-2 py-1 flex items-center gap-1 group">
                <flux:icon.trash-2 class="w-4 h-4" />
                 <span
                    class="absolute left-1/2 -translate-x-1/2 bottom-full mb-2 w-max px-2 py-1 bg-gray-800 text-white text-xs rounded opacity-0 group-hover:opacity-100 transition pointer-events-none z-100">
                    Eliminar
                  </span>
                </flux:button>
            </flux:modal.trigger>
                </td>
                </div>






            </tr>
            @endforeach
        </tbody>
    </table>
                <!-- Paginación -->
{{ $archivos->links() }}
</div>

</x-layouts.app>
