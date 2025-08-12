<!-- filepath: d:\xampp\htdocs\Laravelpracticas\dejavu\resources\views\entidades\index.blade.php -->
<x-layouts.app :title="__('Entidades')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">


        @livewire('entidades-lista', ['entidades' => $entidades])
    </div>

</x-layouts.app>
