{{-- filepath: d:\xampp\htdocs\Laravelpracticas\dejavu\resources\views\components\entidades-modal.blade.php --}}
<flux:modal name="crear-entidad" class="md:w-96">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">Crear Nueva Entidad</flux:heading>
            <flux:text class="mt-2">Complete los campos para crear una nueva entidad.</flux:text>
        </div>

        {{-- FORMULARIO TRADICIONAL DENTRO DEL MODAL FLUX --}}
        <form action="{{ route('entidades.store') }}" method="POST" onsubmit="return interceptarFormulario(this)">
            @csrf

            <div class="space-y-4">
                {{-- Campo nombre --}}
                <flux:input
                    name="name"
                    label="Nombre de la Entidad"
                    placeholder="Ingrese el nombre de la entidad"
                    value="{{ old('name') }}"
                    required
                />

                {{-- Tipo de entidad --}}
                <flux:select name="entity" label="Tipo de Entidad" required>
                    <option value="">Seleccione el tipo</option>
                    <option value="public" {{ old('entity') == 'public' ? 'selected' : '' }}>Pública</option>
                    <option value="private" {{ old('entity') == 'private' ? 'selected' : '' }}>Privada</option>
                </flux:select>

                {{-- Unidad administrativa --}}
                <flux:select name="administrative_unit" label="Unidad Administrativa" required>
                    <option value="">Seleccione la unidad</option>
                    <option value="Secretaría de Educación" {{ old('administrative_unit') == 'Secretaría de Educación' ? 'selected' : '' }}>Secretaría de Educación</option>
                    <option value="Secretaría de Salud" {{ old('administrative_unit') == 'Secretaría de Salud' ? 'selected' : '' }}>Secretaría de Salud</option>
                    <option value="Dirección General" {{ old('administrative_unit') == 'Dirección General' ? 'selected' : '' }}>Dirección General</option>
                </flux:select>

                {{-- Oficina productora --}}
                <flux:select name="producer_office" label="Oficina Productora" required>
                    <option value="">Seleccione la oficina</option>
                    <option value="Subsecretaría de Planeación Educativa" {{ old('producer_office') == 'Subsecretaría de Planeación Educativa' ? 'selected' : '' }}>Subsecretaría de Planeación Educativa</option>
                    <option value="Gestión de Servicios de Salud" {{ old('producer_office') == 'Gestión de Servicios de Salud' ? 'selected' : '' }}>Gestión de Servicios de Salud</option>
                    <option value="Talento Humano" {{ old('producer_office') == 'Talento Humano' ? 'selected' : '' }}>Talento Humano</option>
                </flux:select>
            </div>

            {{-- Botones con la lógica de Flux --}}
            <div class="flex mt-6">
                <flux:spacer />

                <flux:modal.close>
                    <flux:button variant="ghost">Cancelar</flux:button>
                </flux:modal.close>

                <flux:button type="submit" variant="primary">Crear Entidad</flux:button>
            </div>
        </form>
    </div>
</flux:modal>

{{-- Script para interceptar el formulario --}}
<script>
function interceptarFormulario(form) {
    console.log('🚀 INTERCEPTANDO FORMULARIO');
    console.log('📋 Acción:', form.action);
    console.log('📝 Método:', form.method);

    // Capturar datos
    const formData = new FormData(form);
    const datos = {};
    for (let [key, value] of formData.entries()) {
        datos[key] = value;
    }

    console.log('📊 Datos que se envían:', datos);
    console.log('🎯 URL destino:', form.action);

    // Mostrar alerta con datos
    const mensaje = `📋 DATOS DEL FORMULARIO:
━━━━━━━━━━━━━━━━━━━━━━━━━
🏷️ Nombre: ${datos.name || 'VACÍO'}
🏢 Tipo: ${datos.entity || 'VACÍO'}
🏛️ Unidad: ${datos.administrative_unit || 'VACÍO'}
🏪 Oficina: ${datos.producer_office || 'VACÍO'}
🔐 CSRF: ${datos._token ? 'PRESENTE' : 'AUSENTE'}
━━━━━━━━━━━━━━━━━━━━━━━━━
🎯 Destino: ${form.action}

¿Continuar envío?`;

    return confirm(mensaje);
}
</script>
