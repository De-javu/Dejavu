<div>
 <div class=" my-6 w-full space-y-6">
    <h1 class="text-3xl font-bold text-center" >
        {{('Lista de Entidades')}}
    </h1>

      {{-- Mensaje de éxito --}}
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        {{-- Mensaje de error --}}
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        {{-- Errores de validación --}}
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif


<div class="flex justify-end">
    {{-- TRIGGER DEL MODAL FLUX --}}
    <flux:modal.trigger name="crear-entidad">
        <flux:button variant="primary" color="green">
            Crear Entidad
        </flux:button>
    </flux:modal.trigger>
</div>



 </div>
 <div class="bg-dark overflow-x-auto">
    <table class="min-w-full dark:bg-gray-900 shadow-md rounded-lg overflow-hidden" >
        <thead class="dark:bg-gray-700 ">
            <tr>
                <th class="py-3 px-6 text-left text-sm font-semibold">Usuarios Creador</th>
                <th class="py-3 px-6 text-left text-sm font-semibold">Nombre Entidad</th>
                <th class="py-3 px-6 text-left text-sm font-semibold">Tipo de entidad</th>
                <th class="py-3 px-6 text-left text-sm font-semibold">Unidad Administrativa</th>
                <th class="py-3 px-6 text-left text-sm font-semibold">Oficina Productora</th>
                <th class="text-center px-4 py-4 font-semibold">Accion</th>
            </tr>
        </thead>
        <tbody class="text-white-700">
             @foreach($entidades as $entidad)
            <tr class="border-b border-dark-200 dark:border-gray-700">
            <td class="py-3 px-6">{{ $entidad->user->name}}</td>
            <td class="py-3 px-6">{{ $entidad->name }}</td>
            <td class="py-3 px-6">{{ $entidad->entity }}</td>
            <td class="py-3 px-6">{{ $entidad->administrative_unit}}</td>
            <td class="py-3 px-6">{{ $entidad->producer_office }}</td>
            <td class="py-3 px-6 text-center">

         <div class="flex gap-2">
               {{-- Boton editar --}}
            <flux:modal.trigger name="editar-entidad-{{ $entidad->id }}">
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
                 onclick="window.open('{{ route('series_documentales.index',['entidad' => $entidad->id]) }}', '_blank')">
                <flux:icon.folder class="w-4 h-4" />
                 <span
                    class="absolute left-1/2 -translate-x-1/2 bottom-full mb-2 w-max px-2 py-1 bg-gray-800 text-white text-xs rounded opacity-0 group-hover:opacity-100 transition pointer-events-none z-100">
                     Serie Documental
                  </span>
                </flux:button>


              {{-- Boton eliminar --}}
              <flux:modal.trigger name="delete-{{$entidad->id}}">
             <flux:button variant="danger" size="sm" class="px-2 py-1 flex items-center gap-1 group">
                <flux:icon.trash-2 class="w-4 h-4" />
                 <span
                    class="absolute left-1/2 -translate-x-1/2 bottom-full mb-2 w-max px-2 py-1 bg-gray-800 text-white text-xs rounded opacity-0 group-hover:opacity-100 transition pointer-events-none z-100">
                    Eliminar
                  </span>
                </flux:button>
            </flux:modal.trigger>


           <form action="{{ route('entidades.destroy', $entidad->id) }}" method="POST">
                @csrf
                @method('DELETE')
               <flux:modal name="delete-{{$entidad->id}}" class="min-w-[22rem]">
                 <div class="space-y-6">
                  <div>
                    <flux:heading size="lg">Eliminar Registro?</flux:heading>

                    <flux:text class="mt-2">
                        <p>Estas seguro de eliminar el registro de la entidad.</p>
                    </flux:text>
                </div>

                <div class="flex gap-2">
                    <flux:spacer />

                    <flux:modal.close>
                        <flux:button variant="ghost">Cancelar</flux:button>
                    </flux:modal.close>

                    <flux:button type="submit" variant="danger">Eliminar</flux:button>


                </div>
              </div>
             </flux:modal>
            </form>





            {{-- Incluir el modal y pasar la entidad a editar--}}
          <x-entidades-editar-modal :entidad="$entidad" />

            </td>
            </tr>
            @endforeach
        </tbody>
    </table>
 </div>

{{-- incluir el modal al final --}}
@include('components.entidades-modal')

