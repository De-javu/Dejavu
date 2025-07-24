{{-- Modal para crear entidad --}}
<div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-xl w-full max-w-md mx-4">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white">Crear Nueva Entidad</h2>
            <flux:button wire:click="cerrarModal" variant="ghost" size="sm">
                ✕
            </flux:button>
        </div>

        <form action="{{ route('entidades.store') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <div>
                    <flux:input
                        name="name"
                        label="Nombre de la Entidad"
                        type="text"
                        required
                        placeholder="Ingrese el nombre de la entidad"
                        value="{{ old('name') }}"
                    />
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <flux:select name="entity" label="Tipo de Entidad" required>
                        <option value="">Seleccione el tipo</option>
                        <option value="public" {{ old('entity') == 'public' ? 'selected' : '' }}>Pública</option>
                        <option value="private" {{ old('entity') == 'private' ? 'selected' : '' }}>Privada</option>
                    </flux:select>
                    @error('entity')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <flux:input
                        name="administrative_unit"
                        label="Unidad Administrativa"
                        type="text"
                        placeholder="Ingrese la unidad administrativa"
                        value="{{ old('administrative_unit') }}"
                    />
                    @error('administrative_unit')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <flux:input
                        name="producer_office"
                        label="Oficina Productora"
                        type="text"
                        placeholder="Ingrese la oficina productora"
                        value="{{ old('producer_office') }}"
                    />
                    @error('producer_office')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-6">
                <flux:button wire:click="cerrarModal" variant="outline" type="button">
                    Cancelar
                </flux:button>
                <flux:button type="submit" variant="primary">
                    Crear Entidad
                </flux:button>
            </div>
        </form>
    </div>
</div>
