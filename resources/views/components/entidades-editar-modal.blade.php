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
                </flux:select>

                {{-- Unidad administrativa --}}
                <flux:select name="administrative_unit" label="Unidad Administrativa" required>
                    <option value="Secretaría de Educación" {{ old('administrative_unit', $entidad->administrative_unit) == 'Secretaría de Educación' ? 'selected' : '' }}>Secretaría de Educación</option>
                    <option value="Secretaría de Salud" {{ old('administrative_unit', $entidad->administrative_unit) == 'Secretaría de Salud' ? 'selected' : '' }}>Secretaría de Salud</option>
                    <option value="Dirección General" {{ old('administrative_unit', $entidad->administrative_unit) == 'Dirección General' ? 'selected' : '' }}>Dirección General</option>
                </flux:select>

                {{-- Oficina productora --}}
                <flux:select name="producer_office" label="Oficina Productora" required>
                    <option value="Subsecretaría de Planeación Educativa" {{ old('producer_office', $entidad->producer_office) == 'Subsecretaría de Planeación Educativa' ? 'selected' : '' }}>Subsecretaría de Planeación Educativa</option>
                    <option value="Gestión de Servicios de Salud" {{ old('producer_office', $entidad->producer_office) == 'Gestión de Servicios de Salud' ? 'selected' : '' }}>Gestión de Servicios de Salud</option>
                    <option value="Talento Humano" {{ old('producer_office', $entidad->producer_office) == 'Talento Humano' ? 'selected' : '' }}>Talento Humano</option>
                </flux:select>
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
