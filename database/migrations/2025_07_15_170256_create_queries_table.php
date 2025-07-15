<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('queries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); //se crea el atributo que almacenara 'id del usuario'
            $table->unsignedBigInteger('file_id');//se crea el atributo que almacenara 'el id del archivo'
            $table->text('description')->nullable();//se crea el atributo que almacenara 'una descripcin de la consula'
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users'); // indica la llave foranea que almacenaremos en esta tabla
            $table->foreign('file_id')->references('id')->on('upload_files'); // indica la llave forane que almaceneremos

        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('queries');
    }
};
