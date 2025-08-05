<x-layouts.app :title="__('Sub_Series Documentales')">
<div>

        @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif


    <div class="flex justify-between mb-12">

        <div class="mt-6 ml-24">
            <h1 class="text-2xl font-bold">Serie: {{ $serie->name }}</h1>
            <p class="text-gray-600">Sub-series de esta serie documental</p>
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

</div>
@include('components.sub_series_modal', ['serie' => $serie, 'entidad'=>$entidad, 'subSeries' => $subSeries])
</x-layouts.app>
