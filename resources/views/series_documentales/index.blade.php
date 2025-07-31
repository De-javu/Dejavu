<!-- filepath: d:\xampp\htdocs\Laravelpracticas\dejavu\resources\views\series_documentales\index.blade.php -->
<x-layouts.app :title="__('Series Documentales')">

     {{-- Mensaje de éxito --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex items-center justify-between">
        <!-- resto de tu contenido -->
    </div>

<div class="fllex items-center justify-between">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        @if($entidad)
            {{-- Información dinámica de la entidad --}}
          <div class="flex items-center justify-between bg-gray-900 p-4 rounded-lg mb-6">
             <div class="text-sm">
                <h2 class="font-bold text-xl mb-2">Información de la Entidad</h2>
                    <p><strong>Nombre:</strong> {{ $entidad->name }}</p>
                    <p><strong>Tipo:</strong> {{ $entidad->entity == 'public' ? 'Pública' : 'Privada' }}</p>
                    <p><strong>Unidad Administrativa:</strong> {{ $entidad->administrative_unit }}</p>
                    <p><strong>Oficina Productora:</strong> {{ $entidad->producer_office }}</p>
                    <p><strong>Creado por:</strong> {{ $entidad->user->name ?? 'Usuario no disponible' }}</p>
             </div>
             <div class="mr-20">
                    {{-- TRIGGER DEL MODAL FLUX PARA CREAR --}}
                    <flux:modal.trigger name="crear-serieDocumental" >
                    <flux:button variant="primary" color="green" class="w-36 h-20">
                        Crear Serie
                    </flux:button>
                    </flux:modal.trigger>
             </div>
           </div>
        @else
            <div class="text-center py-8">
                <p class="text-red-500">No se recibió información de la entidad.</p>
            </div>
        @endif
    </div>
</div>
<hr>
 {{-- SECCIÓN DE SERIES DOCUMENTALES SE LISTAN CADA UNA CON SU FUNCION --}}
<div class="  grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 mx-1 m-2  justify-between gap-6">
   @foreach ($series as $serie)
    <div class="flex items-center justify-between p-2 group">
        <a href="#" class="flex items-center gap-2 px-4 py-2 rounded relative text-black-600 hover:text-blue-200">
            <span class="text-6xl m-auto">📁</span>
            {{ $serie->name }}
            <span class="absolute left-1/2 -translate-x-1/2 bottom-full mb-2 w-max px-2 py-1 bg-gray-800 text-white text-xs rounded opacity-0 group-hover:opacity-200 transition pointer-events-none z-10">
                Serie Documental
            </span>
        </a>
        <div>
            {{-- Boton del menu de seleccion --}}
            <flux:dropdown>
                <flux:button icon:trailing="chevron-down"></flux:button>
                <flux:menu>
                     {{-- Boton entrar --}}
                     <flux:modal.trigger name="entrar-series{{$serie->id}}"
                     onclick="window.location.href='{{ route('series_documentales.show',$serie->id) }}'">
                    <flux:menu.item icon="document" kbd="⌘D">
                        Entrar
                    </flux:menu.item>
                     </flux:modal.trigger>

                    {{-- Boton editar --}}
                    <flux:modal.trigger name="editar-serie-{{$serie->id}}">
                    <flux:menu.item icon="pencil-square" kbd="⌘S">
                        Editar
                    </flux:menu.item>
                    </flux:modal.trigger>

                     {{-- Boton eliminar--}}
                     <flux:modal.trigger name="delete-serie-{{$serie->id}}">
                     <flux:menu.item icon="trash" variant="danger" kbd="⌘⌫">
                            Eliminar
                    </flux:menu.item>
                    </flux:modal.trigger>
                </flux:menu>
            </flux:dropdown>

            <form action="{{ route('series_documentales.destroy', $serie->id) }}" method="POST">
                @csrf
                @method('DELETE')
               <flux:modal name="delete-serie-{{$serie->id}}"  class="min-w-[22rem]">
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
        </div>
    </div>
  @endforeach

</div>
@include('components.series-documentales-modal',['series' => $series, 'entidad' => $entidad])
</x-layouts.app>
