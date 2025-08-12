<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
@include('cargar_archivos.index', ['estructura' => $estructura])
    </div>
</x-layouts.app>
