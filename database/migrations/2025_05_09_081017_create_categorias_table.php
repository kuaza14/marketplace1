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
        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->string(column: 'nombre')->unique();
            $table->string(column: 'slug')->unique();
            $table->string(column: 'descripcion')->nullable();
            $table->string(column: 'imagen')->nullable();
            $table->string(column: 'estado')->default(value: true);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categorias');
    }
};
