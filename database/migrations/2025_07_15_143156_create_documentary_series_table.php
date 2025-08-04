<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;
use function Livewire\Volt\updated;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('documentary_series', function (Blueprint $table) {
            $table->id(); // se crea el atributo que almacenara la llave primaria.
            $table->string('name'); // Se crea el atributo que almacenara el nombre de la 'serie_documental'

            $table->unsignedBigInteger('user_id'); //se crea el atributo que recogera el 'user_id'

            $table->unsignedBigInteger('parent_series_id') // Se crea un atributo que almacenara el nombre la "serie_padre"
                  ->nullable();// Permte que una carpeta no tenga carpeta padre, dando flexibilidad a la estructura jerárquica llena la columna con null si no tiene carpeta padre


            $table->unsignedBigInteger('entity_id'); // secrea un atrubuto que almacenara el nomnbre de la entidad relacionada
            $table->timestamps();

            $table->foreign('user_id')// Indica que se crea una llave forania con el atrubuto 'user_id'
                  ->references('id') // Se encargara de buscar el atributo 'id'
                  ->on('users'); // Lo buscara en la tabla 'user'

            $table->foreign('parent_series_id') // Se crea una llave foranea con el atrubuto 'parent_series_id'
                  ->references('id') // Indica que se conectara con el atributo 'id'
                  ->on('documentary_series') // Buscara el atribut en la tabla 'documentary_series'
                  ->onDelete('cascade') // Tendra la funcion de auto eliminado en casascada
                  ->onUpdated('cascade');// Tendra la funcion de actulizacion en cascada.

            $table->foreign('entity_id') // Se crea ua llave foranea con  el atributo 'entity_id'
                  ->references('id') // El cual se conectara con el atributo 'id'
                  ->on('entities') // buscara el atrubuto en la tabla 'entities'
                  ->onDelete('cascade') // Tendra la funcion de auto eliminado en casascada
                  ->onUpdated('cascade');// Tendra la funcion de actulizacion en cascada.

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentary_series');
    }
};
