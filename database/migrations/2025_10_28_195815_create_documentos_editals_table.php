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
        Schema::create('documentos_editals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_edital')->constrained('editals')->onDelete('cascade');
            $table->foreignId('id_documento')->constrained('documentos')->onDelete('cascade');
            $table->timestamps();
            
            // Evitar duplicatas
            $table->unique(['id_edital', 'id_documento']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentos_editals');
    }
};
