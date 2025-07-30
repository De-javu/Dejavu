{{-- Modal para crear (siempre disponible) --}}
<flux:modal name="crear-serieDocumental" class="md:w-96">
    @livewire('series-documentale-crear', ['entidad' => $entidad])
</flux:modal>

{{-- Modales para editar cada serie --}}
@if(isset($series))
    @foreach($series as $serie)
        <flux:modal name="editar-serie-{{ $serie->id }}" class="md:w-96">
            @livewire('series-documentale-crear', ['entidad' => $entidad, 'serie' => $serie])
        </flux:modal>
    @endforeach
@endif

