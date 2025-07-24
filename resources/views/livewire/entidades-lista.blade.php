<div>
 <div class=" my-6 w-full space-y-6">
    <h1 class="text-3xl font-bold text-center" >
        {{('Lista de Entidades')}}
    </h1>

<div class="flex justify-end">
    {{-- TRIGGER DEL MODAL FLUX --}}
    <flux:modal.trigger name="crear-entidad">
        <flux:button variant="primary" color="green">
            Crear Entidad
        </flux:button>
    </flux:modal.trigger>
</div>



 </div>
 <div class="bg-dark overflow-x-auto">
    <table class="min-w-full dark:bg-gray-900 shadow-md rounded-lg overflow-hidden" >
        <thead class="dark:bg-gray-700 ">
            <tr>
                <th class="py-3 px-6 text-left text-sm font-semibold">Usuarios Creador</th>
                <th class="py-3 px-6 text-left text-sm font-semibold">Nombre Entidad</th>
                <th class="py-3 px-6 text-left text-sm font-semibold">Tipo de entidad</th>
                <th class="py-3 px-6 text-left text-sm font-semibold">Unidad Administrativa</th>
                <th class="py-3 px-6 text-left text-sm font-semibold">Oficina Productora</th>
                <th class="text-center px-4 py-4 font-semibold">Accion</th>
            </tr>
        </thead>
        <tbody class="text-white-700">
             @foreach($entidades as $entidad)
            <tr class="border-b border-dark-200 dark:border-gray-700">
            <td class="py-3 px-6">{{ $entidad->user->name}}</td>
            <td class="py-3 px-6">{{ $entidad->name }}</td>
            <td class="py-3 px-6">{{ $entidad->entity }}</td>
            <td class="py-3 px-6">{{ $entidad->administrative_unit}}</td>
            <td class="py-3 px-6">{{ $entidad->producer_office }}</td>
            <td class="py-3 px-6 text-center">
                <flux:button variant="primary" color="yellow" size="sm">
                    Editar
                </flux:button>
                <flux:button variant="danger" size="sm">
                    Eliminar
                </flux:button>
            </td>
            </tr>
            @endforeach
        </tbody>
    </table>
 </div>

{{-- E incluir el modal al final --}}
@include('components.entidades-modal')
