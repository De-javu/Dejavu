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
            $table->string('name') // ¿Se utlizara un string de gran tamaño para el 'nombre'
            ->unique(); // Sera un campo con nombre unico

            $table->unsignedBigInteger('user_id'); //se almacenara el id de la tabla user


            $table->enum('entity', ['public', 'private']); // Se crea un campo de seleccion para el typo de entidad.
            $table->unsignedBigInteger('administrative_unit')->nullable(); // Se urilizara para la columna  unidad administrativa
            $table->unsignedBigInteger('producer_office')->nullable(); // Se utilizara para la columna de oficina producttora
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
