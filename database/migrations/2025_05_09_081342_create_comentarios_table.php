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
        Schema::create('comentarios', function (Blueprint $table) {
            $table->id();
            $table->string(column: 'descripcion')->nullable();
            $table->string(column: 'estado')->default(value: true);
            $table->integer(column: 'valoracion');
            
            $table->foreignId(column: 'producto_id')->constrained(table: 'productos');
            $table->foreignId(column: 'usuario_id')->constrained(table: 'usuarios');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comentarios');
    }
};
