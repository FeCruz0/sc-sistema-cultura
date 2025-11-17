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
        Schema::create('respostas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pergunta')->constrained('perguntas')->onDelete('cascade');
            $table->foreignId('id_alternativa')->nullable()->constrained('alternativas')->onDelete('cascade');
            $table->foreignId('id_inscricao')->constrained('inscricaos')->onDelete('cascade');
            $table->text('texto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('respostas');
    }
};
