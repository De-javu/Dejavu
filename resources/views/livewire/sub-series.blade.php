<div>
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">
             {{$serie && $entidad && isset($subSerie) ? 'Editar Sub_serie documental'  : 'Crea sub_serie Documental' }}
             </flux:heading>
        </div>

         {{-- FORMULARIO TRADICIONAL DENTRO DEL MODAL FLUX --}}
        <form
        action=" {{$serie && $entidad && isset($subSerie) ? route('sub_editar',['serie' => $subSerie->id] ) : route('sub_carpeta',['serie' => $serie->id] ) }}"
        method="POST">
            @csrf
            @if($serie && $entidad && isset($subSerie))
            @method('PUT')
            @csrf
            @endif

            <div class="space-y-4">
                {{-- Campo nombre --}}
                <flux:input
                    name="name"
                    label="Nombre sub serie documental"
                    placeholder="Nombre "
                    value="{{ old('name', isset($subSerie) ? $subSerie->name : '') }}"
                    required/>

                     @if($serie)
                        <strong>Serie:</strong> {{ $serie->name }}
                        <input type="hidden" name="parent_series_id" value="{{$serie->id}}">
                        @endif

                         @if($entidad)
                        <strong>Entidad:</strong> {{ $entidad->name }}
                        <input type="hidden" name="entity_id" value="{{$entidad->id}}">
                        @endif

                       @if($subSerie)
                        <strong>Sub Serie:</strong> {{$subSerie->name }}
                       <input type="hidden" name="parent_series_id" value="{{$serie->id}}">
                      @endif

             </div>
            {{-- Botones con la lógica de Flux --}}
            <div class="flex mt-6">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="ghost">Cancelar</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="primary">
                    {{$serie && $entidad && isset($subSerie) ? 'Actualizar' : 'Crear' }}
                </flux:button>
            </div>
        </form>
</div>
