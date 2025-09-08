<flux:modal name="Cargar-Archivos" class="w-[80%]">
    <div class="space-y-4">
        <div>
            <flux:heading size="lg">Cargar Archivos maximo  10 </flux:heading>
            <flux:text class="mt-2">Complete los datos para cargar archivos</flux:text>
        </div>

        <form action="{{ route('cargar_archivos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Campos ocultos con los IDs seleccionados --}}
            <input type="hidden" name="entidad_id" id="entidad" value="{{ $entidad_id }}">
            <input type="hidden" name="serie_id" id="serie"value="{{ $serie_id }}">
            <input type="hidden" name="subserie_id" id="subserie"value="{{ $subserie_id }}">



            {{-- Campos principales del formulario --}}
            <div class="space-y-4">
                <flux:input
                    name="name"
                    id=nombre
                    label="Ingresa el nombre personalizado que deseas "
                    type="text"
                    placeholder="Si no ingrsas Tomara el nombre original del archivo "
                    value="{{ old('name') }}"
                />
                <flux:input
                    name="start_date"
                    id="fecha_inicial"
                    label="Fecha inicial"
                    type="date"
                    value="{{ old('start_date') }}"
                    required
                />
                <flux:input
                    name="end_date"
                    id="fecha_final"
                    label="Fecha final"
                    type="date"
                    value="{{ old('end_date') }}"
                    required
                />
                <flux:input
                 type="file"
                 name="archivo[]"
                 wire:model=""
                 label="Adjuntar archivos maximo 10 por session "
                 multiple
                required
                  />
            </div>
            {{-- Botones --}}
            <div class="flex justify-end space-x-2 mt-6">
                <flux:modal.close>
                    <flux:button variant="ghost">Cancelar</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="primary">Cargar archivo</flux:button>
            </div>
        </form>
    </div>
</flux:modal>



