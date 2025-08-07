<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Ramsey\Uuid\Type\Integer;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

public function up(): void
{
    Schema::create('upload_files', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id'); // se crea un atributo que recoge la llave foranea
        $table->unsignedBigInteger('documentary_series_id'); // se crea un atributo que recoge la llave foranea
        $table->unsignedBigInteger('parent_series_id')->nullable(); // se crea un atributo que recoge la llave foranea
        $table->unsignedBigInteger('entity_id'); // se crea un atributo que recoge la llave foranea

        // Campos mejorados para nomenclatura
        $table->string('original_name');     // "memorando_finanzas_20250807_03.pdf"
        $table->string('display_name')->nullable(); // Nombre personalizado (opcional)
        $table->string('extension');         // "pdf"
        $table->string('mime_type');         // "application/pdf"
        
        $table->string('path'); // Se crea el atributo que almacenara la ruta
        $table->unsignedBigInteger('folio'); // Se crea el atributo que almacenara 'la cantidad de folios'
        $table->unsignedBigInteger('size'); // Se crea el atributo que almacenara 'El peso del Archivo'
        $table->dateTime('start_date'); // Se crea el atributo que almacenara 'La fecha extrema inicial'
        $table->dateTime('end_date'); // Se crea el atributo que almacenara 'la fecha extrema final'
        $table->string('hash_code')->unique(); // Se crea el atributo que almacenara 'el codigo hash'
        

        // Campos para normativa (OPCIONALES para flexibilidad)
        $table->string('trd_code')->nullable();              // "17" - Código TRD
        $table->integer('central_retention_years')->nullable(); // 5 - Años en archivo central
        $table->string('final_disposition')->nullable();     // "conservar_permanentemente", "eliminar", "seleccionar"
        $table->text('retention_notes')->nullable();         // Notas adicionales de retención
        
        
        
        $table->timestamps();      
        
        // Índice único actualizado para usar original_name
        $table->unique(['parent_series_id', 'original_name']); // indice compuesto para archivos mismo nombre diferente carpeta

        // Llaves foráneas
        $table->foreign('user_id')->references('id')->on('users');
        $table->foreign('documentary_series_id')->references('id')->on('documentary_series')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('parent_series_id')->references('id')->on('documentary_series')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('entity_id')->references('id')->on('entities')->onDelete('cascade')->onUpdate('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('upload_files');
    }
};
