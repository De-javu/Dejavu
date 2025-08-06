{{-- Modal para crear (siempre disponible) --}}
<flux:modal name="crear-sub_series" class="md:w-96">
        @livewire('sub-series', ['serie' => $serie, 'entidad' => $entidad ])
</flux:modal>

{{--Modal Para editra sub serie Documnetakl --}}

@if(isset($subSeries))
   @foreach ( $subSeries as $subSerie )
        <flux:modal name="editar-serie-{{$subSerie->id}}" class="md:w-96">
                @livewire('sub-series', ['serie' => $serie, 'entidad' => $entidad, 'subSerie' => $subSerie])
        </flux:modal>
   @endforeach
@endif
