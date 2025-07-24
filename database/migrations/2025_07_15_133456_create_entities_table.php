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


            $table->enum('entity', ['public', 'private']); // Se crea un campo de seleccion para el typo de entidad.
            $table->enum('administrative_unit', ['Secretaría de Educación', 'Secretaría de Salud','Dirección General',]); // Se urilizara para la columna  unidad administrativa
            $table->enum('producer_office', ['Subsecretaría de Planeación Educativa', 'Gestión de Servicios de Salud', 'Talento Humano']); // Se utilizara para la columna de oficina producttora
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
