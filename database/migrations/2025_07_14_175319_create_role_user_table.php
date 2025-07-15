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
        Schema::create('role_user', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id'); //Se crea atributo de gran tamaño para almacenar user_id
            $table->unsignedBigInteger('role_id'); //Se crea atributo de gran tamaño para almacenar role_id
            $table->timestamps();

            $table->primary(['user_id','role_id']); // Se hacer referencia con una propidad primaria, por que la tabla es pivote y no tine id propio, asi evitamos duplicidad
            $table->foreign('user_id') // se crea un un atributo foraneo que almacenara la informacion 'users_id'
                  ->references('id') // indica que se conectara con el  atributo 'id'
                  ->on('users') // Se relacina con la tabla 'users'
                  ->onDelete('cascade'); // Si sucede algo con el id de referencia, tendra la misma reaccion

            $table->foreign('role_id') // Se define un atributo foranea que se alamacenara'role_id'
                  ->references('id') // indica que apuntara  al atributo 'id'
                  ->on('roles') // Se relaciona con la tabla 'roles'
                  ->onDelete('cascade'); // Si sucede algo con el id de referencia, tendra la misma reaccion
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_user');
    }
};
