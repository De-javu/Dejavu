<!-- filepath: d:\xampp\htdocs\Laravelpracticas\dejavu\resources\views\entidades\index.blade.php -->
<x-layouts.app :title="__('Entidades')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

        {{-- Mensaje de éxito --}}
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        {{-- Mensaje de error --}}
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        {{-- Errores de validación --}}
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        @livewire('entidades-lista', ['entidades' => $entidades])
    </div>
</x-layouts.app>
