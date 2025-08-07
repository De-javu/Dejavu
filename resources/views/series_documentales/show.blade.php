<x-layouts.app :title="__('Sub_Series Documentales')">
<div>

        @if(session('success'))
           <div class="alert alert-success">
           {{ session('success') }}
           </div>
        @endif


    <div class="flex justify-between mb-12">

        <div class="mt-6 ml-24">
            <h1 class="text-2xl font-bold">Unidad Documental: {{$serie->name}}</h1>
            @foreach ($subSeries as $subSerie)
    <div>
        <strong>Sub-serie:</strong> {{$subSerie->name}}
    </div>
    @endforeach

        </div>

        <div class="flex justify-end mr-32">
            {{-- TRIGGER DEL MODAL FLUX PARA CREAR --}}
            <flux:modal.trigger name="crear-sub_series" >
            <flux:button variant="primary" color="green" class="w-36 h-20">
                Crear Sub Series
            </flux:button>
            </flux:modal.trigger>
        </div>
    </div>
<hr>

{{-- SECCIÓN DE SUB SERIES DOCUMENTALES SE LISTAN CADA UNA CON SU FUNCION --}}
<div class="  grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 mx-1 m-2  justify-between gap-6">
   @foreach ($subSeries as $subSerie)
    <div class="flex items-center justify-between p-2 group">
        <a href="#" class="flex items-center gap-2 px-4 py-2 rounded relative text-black-600 hover:text-blue-200">
            <span class="text-6xl m-auto">📁</span>
            {{$subSerie->name }}
            <span class="absolute left-1/2 -translate-x-1/2 bottom-full mb-2 w-max px-2 py-1 bg-gray-800 text-white text-xs rounded opacity-0 group-hover:opacity-200 transition pointer-events-none z-10">
                Sub Serie Documental
            </span>
        </a>
        <div>
            {{-- Boton del menu de seleccion --}}
            <flux:dropdown>
                <flux:button icon:trailing="chevron-down"></flux:button>
                <flux:menu>
                     {{-- Boton entrar --}}
                     <flux:modal.trigger name="entrar-series{{$subSerie->id}}"
                     onclick="window.location.href='{{ route('series_documentales.show',$subSerie->id) }}'">
                    <flux:menu.item icon="document" kbd="⌘D">
                        Entrar
                    </flux:menu.item>
                     </flux:modal.trigger>

                    {{-- Boton editar --}}
                    <flux:modal.trigger name="editar-serie-{{$subSerie->id}}">
                    <flux:menu.item icon="pencil-square" kbd="⌘S">
                        Editar
                    </flux:menu.item>
                    </flux:modal.trigger>

                     {{-- Boton eliminar--}}
                     <flux:modal.trigger name="delete-serie-{{$subSerie->id}}">
                     <flux:menu.item icon="trash" variant="danger" kbd="⌘⌫">
                            Eliminar
                    </flux:menu.item>
                    </flux:modal.trigger>
                </flux:menu>
            </flux:dropdown>

            <form action="{{ route('series_documentales.destroy', $subSerie->id) }}" method="POST">
                @csrf
                @method('DELETE')
               <flux:modal name="delete-serie-{{$subSerie->id}}"  class="min-w-[22rem]">
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

</div>
@include('components.sub_series_modal', ['serie' => $serie, 'entidad'=>$entidad, 'subSeries' => $subSeries])
</x-layouts.app>
