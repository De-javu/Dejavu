<x-layouts.app :title="__('Sub_Series Documentales')">
<div>


    <div class="flex justify-between mb-12">

        <div class="mt-6 ml-24">
            <h1 class="text-2xl font-bold">Serie: {{ $serie->name }}</h1>
            <p class="text-gray-600">Sub-series de esta serie documental</p>
        </div>

        <div class="flex justify-end mr-32">
            {{-- TRIGGER DEL MODAL FLUX PARA CREAR --}}
            <flux:modal.trigger name="crear-sub_serie" >
            <flux:button variant="primary" color="green" class="w-36 h-20">
                Crear Sub Series
            </flux:button>
            </flux:modal.trigger>
        </div>
    </div>
<hr>

</div>
</x-layouts.app>
