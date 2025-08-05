{{-- Modal para crear (siempre disponible) --}}
<flux:modal name="crear-sub_series" class="md:w-96">
    @if($serie && $serie)
        @livewire('sub-series', ['serie' => $serie, 'entidad' => $entidad, 'subSeries' => $subSeries])
    @else
        <p>Error: No se pudo cargar la información de la serie.</p>
    @endif
</flux:modal>
