<div>

    <div class="space-y-6">
        <div>
            <flux:heading size="lg">Crea sub_serie Documental</flux:heading>
        </div>

        {{-- FORMULARIO TRADICIONAL DENTRO DEL MODAL FLUX --}}
        <form
        action=" {{ route('sub_carpeta',['serie' => $serie->id] ) }}"
        method="POST">
            @csrf
            <div class="space-y-4">
                {{-- Campo nombre --}}
                <flux:input
                    name="name"
                    label="Nombre sub serie documental"
                    placeholder="Nombre "
                    value="{{ old('name') }}"
                    required/>

                     @if($serie)
                        <strong>Serie:</strong> {{ $serie->name }}
                        <input type="hidden" name="parent_series_id" value="{{$serie->id}}">
                        @endif

                         @if($entidad)
                        <strong>Entidad:</strong> {{ $entidad->name }}
                        <input type="hidden" name="entity_id" value="{{$entidad->id}}">
                        @endif

             </div>
            {{-- Botones con la lógica de Flux --}}
            <div class="flex mt-6">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="ghost">Cancelar</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="primary">
                    {{'Crear' }}
                </flux:button>
            </div>
        </form>
    </div>


</div>
