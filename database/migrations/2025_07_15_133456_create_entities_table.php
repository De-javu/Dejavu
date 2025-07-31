<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('entities', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // ¿Se utlizara un string de gran tamaño para el 'nombre'

            $table->unsignedBigInteger('user_id'); //se almacenara el id de la tabla user


            $table->enum('entity', ['public', 'private', 'mixta']); // Se crea un campo de seleccion para el typo de entidad.
            $table->string('administrative_unit', ); // Se urilizara para la columna  unidad administrativa
            $table->string('producer_office'); // Se utilizara para la columna oficina productora

            $table->unique([  // Se crea una combinacion unica de los campos para evitar duplicados
                'name',
                'entity',
                'administrative_unit',
                'producer_office'],
          'unique_entity_combination');

            $table->timestamps();

            $table->foreign('user_id') // Se crea una referencia de llave foranea en el atributo  'user_id'
                  ->references('id')  // Indica que la refenecia apuntara al atributo 'id'
                  ->on('users'); // Buscara el atributo de conexion  en la tabla user


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entities');
    }
};
