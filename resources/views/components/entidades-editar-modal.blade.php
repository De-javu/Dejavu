{{-- filepath: resources/views/components/entidades-editar-modal.blade.php --}}
<flux:modal name="editar-entidad-{{ $entidad->id }}" class="md:w-96">
    <div class="space-y-6">

          <div>
            <flux:heading size="lg">Editar</flux:heading>
            <flux:text class="mt-2">Complete los campos para editar o actualizar los datos de una entidad.</flux:text>
        </div>
        <form action="{{ route('entidades.update', $entidad->id) }}" method="POST">
            @csrf
            @method('PUT')
            <flux:input
                    name="name"
                    label="Nombre de la Entidad"
                    placeholder="Ingrese el nombre de la entidad"
                    value="{{ $entidad->name}}"
                    required
                />

                {{-- Tipo de entidad --}}
                <flux:select name="entity" label="Tipo de Entidad" required>
                    <option value="public" {{ old('entity', $entidad->entity) == 'public' ? 'selected' : '' }}>Pública</option>
                    <option value="private" {{ old('entity', $entidad->entity) == 'private' ? 'selected' : '' }}>Privada</option>
                    <option value="mixta" {{ old('entity', $entidad->entity) == 'mixta' ? 'selected' : '' }}>Mixta</option>
                </flux:select>

                 <!-- Unidad Administrativa -->
                    <flux:input
                        name="administrative_unit"
                        label="Unidad Administrativa"
                        placeholder="Ej: Secretaría de Planeación Municipal"
                        value="{{ old('administrative_unit', $entidad->administrative_unit) }}"
                        required/>

               <!-- Oficina Productora -->
                    <flux:input
                        name="producer_office"
                        label="Oficina Productora"
                        placeholder="Ej: Subsecretaría de Desarrollo Territorial"
                        value="{{ old('producer_office', $entidad->producer_office) }}"
                        required/>
            </div>

            <div class="flex mt-6">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="ghost">Cancelar</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="primary">Actualizar</flux:button>
            </div>
        </form>
    </div>
</flux:modal>
