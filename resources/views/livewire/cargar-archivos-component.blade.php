<div class="space-y-4">
    <h1 class="text-4xl text-center max-w-auto">
        Carga de archivos Max 10 archivos
    </h1>
    {{-- Selector de entidades --}}
<div class="w-full">
    <label class="block text-lg font-medium  text-gray-900 dark:text-gray-100">
    <flux:select wire:model.live="entidad_id" class="your-custom-styles">
        <flux:select.option value="">Selecciona una entidad</flux:select.option>
        @foreach ($estructura as $entidad)
            <flux:select.option value="{{ $entidad->id }}">
               Entidad: {{ $entidad->name }}|| Unidad: {{ $entidad->administrative_unit }} || Oficina: {{ $entidad->producer_office }}
            </flux:select.option>
        @endforeach
    </flux:select>
</div>

    {{-- Selector de series que no depende de otra --}}

@if($entidad_id)
    <div class="w-full">
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
        </label>
        @php
            $entidadSeleccionada = collect($estructura)->firstWhere('id', $entidad_id);
            $seriesRaiz = $entidadSeleccionada && $entidadSeleccionada->documentarySeries
                ? collect($entidadSeleccionada->documentarySeries)->filter(function($serie) {
                    return $serie->parent_series_id === null;
                })
                : collect() ;
        @endphp

          {{-- Visulizacion zoom de la entidad prodcutora --}}

@if($entidadSeleccionada)
 <div class="flex flex-wrap justify-between items-center mb-2">
    <div>
         <h1 class="text-lg">Entidad</h1>
         <p class="text-sm">{{ $entidadSeleccionada->name}}</p>
    </div>
    <div>
         <h1 class="text-lg">Unidad Administrativa</h1>
         <p class="text-sm">{{$entidadSeleccionada->administrative_unit}}</p>
    </div>
    <div>
         <h1 class="text-lg">Oficina productora</h1>
         <p class="text-sm">{{$entidadSeleccionada->producer_office}}</p>
    </div>
</div>
@endif
      {{-- Se encarga validar si se tiene una serie raiz, para que se habiliten las subserie que contiene --}}
        @if($seriesRaiz->count())
            <flux:select wire:model.live="serie_id"
                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-blue-500 dark:focus:border-blue-400">
                <flux:select.option value="">Selecciona una serie</flux:select.option>
                @foreach ($seriesRaiz as $serie)
                    <flux:select.option value="{{ $serie->id }}">{{ $serie->name }}</flux:select.option>
                @endforeach
            </flux:select>
        @endif
    </div>
@endif

    {{-- Selector de subseries --}}
    @if($serie_id && $entidadSeleccionada)
        <div class="w-full">
            <label class="block text-sm font-medium text-gray-700 mb-2">
            </label>
            @php
                $serieSeleccionada = collect($entidadSeleccionada->documentarySeries)->firstWhere('id', $serie_id);
            @endphp

            @if($serieSeleccionada && $serieSeleccionada->children)
                <flux:select wire:model.live="subserie_id"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <flux:select.option value="">Selecciona una sub-serie</flux:select.option>
                    @foreach ($serieSeleccionada->children as $subserie)
                        <flux:select.option value="{{ $subserie->id }}">{{ $subserie->name }}</flux:select.option>
                    @endforeach
                </flux:select>
            @endif
        </div>
    @endif
    <hr>

    @if($entidad_id && $serie_id && !empty($subserie_id))

    <div class="flex justify-center item-center  mx-auto ">
            {{-- TRIGGER DEL MODAL FLUX PARA CREAR --}}
            <flux:modal.trigger name="Cargar-Archivos" >
            <flux:button variant="primary" color="green" class="w-[40%] h-12">
                <h1 class="text-3xl">
                    Cargar Archivos
                </h1>
            </flux:button>
            </flux:modal.trigger>
        </div>
    @endif

    {{-- Mostrar mensajes de éxito --}}
@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

    {{-- Se encarga de recibir los datos de exito desde el controalsr paara que se muetsren en la vista  --}}
    @if(session('archivos_guardados'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        <strong>{{ session('success') }}</strong>
        <ul class="mt-2">
            @foreach(session('archivos_guardados') as $archivo)
                <li>
                    <a href="{{ $archivo['url'] }}" target="_blank" class="text-blue-600 hover:underline">
                        📄 {{ $archivo['nombre'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endif

{{-- Mostrar errores --}}
@if(session('archivos_error') && count(session('archivos_error')) > 0)
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <strong>Archivos con problemas:</strong>
        <ul>
            @foreach(session('archivos_error') as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
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

 {{-- Incluir el modal pasando las variables --}}
    @include('components.cargar_archivos_modal', [
        'entidad_id' => $entidad_id,
        'serie_id' => $serie_id,
        'subserie_id' => $subserie_id,
        'mostrarExtras' => $mostrarExtras,
    ])
</div>








