<x-layouts.app :title="__('Archivos')">
<div>
    <h1>Carga De archvios digitales</h1>
</div>
<div class="overflow-x-auto">
    <table class= "min-w-full dark:bg-gray-900 shadow-md rounded-r-lg overflow-hidden">
        <thead class= "dark:bg-gray-700">
            <tr>
                <th class="py-3 px-6 text-left">user_id</th>
                <th class="py-3 px-6 text-left">documentary_series_id</th>
                <th class="py-3 px-6 text-left">parent_series_id</th>
                <th class="py-3 px-6 text-left">entity_id</th>
                <th class="py-3 px-6 text-left">original_name</th>
                <th class="py-3 px-6 text-left">extension</th>
                <th class="py-3 px-6 text-left">mime_type</th>
                <th class="py-3 px-6 text-left">start_date</th>
                <th class="py-3 px-6 text-left">end_date</th>
                <th class="py-3 px-6 text-left">hash_code</th>
                <th class="py-3 px-6 text-left">central_retention_years</th>
                <th class="py-3 px-6 text-left">final_disposition</th>
                <th class="py-3 px-6 text-left">final_disposition</th>
                <th class="py-3 px-6 text-left">retention_notesth>
            </tr>
        </thead>
        <tbody>
            @foreach ($archivos As $documento)
            <tr>
               <td>{{ $documento->user->name}}</td>
               <td>    
                <td>{{ $documento->documentarySerie?->name }}</td>
                 <td>{{ $documento->parentSeries?->name }}</td>          
                
                </td>
                <td>{{ $documento->extension}}</td>


            </tr>
            @endforeach
        </tbody>
    </table>
                <!-- Paginación -->
{{ $archivos->links() }}
</div>

</x-layouts.app>
