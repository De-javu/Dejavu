<div>
  <div class="space-y-6">
        <div>
            <flux:heading size="lg">
                {{$editar  && $serie ? 'Editar Serie  Documental' : 'Crear serie documenetal' }} 
            </flux:heading>
            <flux:text class="mt-2">Serie documnetal.</flux:text>
        </div>
     {{-- FORMULARIO TRADICIONAL DENTRO DEL MODAL FLUX --}}
        <form
        action=" {{ $editar && $serie ? route('series_documentales.update', $serie->id) : route('series_documentales.store') }}"
        method="POST">
            @csrf
             @if($editar && $serie)
             @method('PUT')
            @endif
            <div class="space-y-4">
                {{-- Campo nombre --}}
                <flux:input
                    name="name"
                    label="Nombre serie docuemental"
                    placeholder="Nombre "
                    value="{{ old('name') }}"
                    required/>

                    <div class="grid">
                        @if($editar && $serie)
                        <strong>Serie Documental:
                        </strong> {{ $serie->name }}
                        @endif

                        @if($entidad )
                        <strong>Entidad:</strong> {{ $entidad->name }}
                        <input type="hidden" name="entity_id" value="{{$entidad->id}}">
                        @endif
                    </div>

             </div>
            {{-- Botones con la lógica de Flux --}}
            <div class="flex mt-6">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="ghost">Cancelar</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="primary">
                    {{$editar && $serie ? 'Actualizar' : 'Crear' }}
                </flux:button>
            </div>
        </form>
    </div>

