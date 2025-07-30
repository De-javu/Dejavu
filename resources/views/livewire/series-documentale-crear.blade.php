<div>
  <div class="space-y-6">
        <div>
            <flux:heading size="lg">Formualrio para crear serie docoumental</flux:heading>
            <flux:text class="mt-2">Serie documnetal.</flux:text>
        </div>
     {{-- FORMULARIO TRADICIONAL DENTRO DEL MODAL FLUX --}}
        <form
        action="{{ route('series_documentales.store') }}"
        method="POST">
            @csrf
            <div class="space-y-4">
                {{-- Campo nombre --}}
                <flux:input
                    name="name"
                    label="Nombre serie docuemental"
                    placeholder="Serie"
                    value="{{ old('name') }}"
                    required/>

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
                <flux:button type="submit" variant="primary">Crear Serie</flux:button>
            </div>
        </form>

    </div>

