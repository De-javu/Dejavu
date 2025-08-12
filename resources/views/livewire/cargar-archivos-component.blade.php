<div class="space-y-6">
    {{-- Selector de entidades --}}
    <div class="w-full">
        <label class="block text-sm font-medium mb-4 text-gray-900 dark:text-gray-100">
            Selecciona una Entidad
        </label>
        <select wire:model.live="entidad_id"
                class="w-full px-3 py-2 border border-gray-200 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-gray-500">
            <option value="">Selecciona una entidad</option>
            @foreach ($estructura as $entidad)
                <option value="{{ $entidad->id }}">{{ $entidad->name }}</option>
            @endforeach
        </select>
    </div>

    {{-- Selector de series --}}

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

        @if($seriesRaiz->count())
            <select wire:model.live="serie_id"
                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-blue-500 dark:focus:border-blue-400">
                <option value="">Selecciona una serie</option>
                @foreach ($seriesRaiz as $serie)
                    <option value="{{ $serie->id }}">{{ $serie->name }}</option>
                @endforeach
            </select>
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
                <select wire:model="subserie_id"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Selecciona una sub-serie</option>
                    @foreach ($serieSeleccionada->children as $subserie)
                        <option value="{{ $subserie->id }}">{{ $subserie->name }}</option>
                    @endforeach
                </select>
            @endif
        </div>
    @endif
    <hr>
    
</div>





