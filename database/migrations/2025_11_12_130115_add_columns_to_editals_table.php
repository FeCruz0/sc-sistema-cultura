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
       if (Schema::hasTable('editals')) {
            Schema::table('editals', function (Blueprint $table) {
                if (! Schema::hasColumn('editals', 'titulo')) {
                    $table->string('titulo')->after('id');
                }
                if (! Schema::hasColumn('editals', 'descricao')) {
                    $table->text('descricao')->nullable()->after('titulo');
                }
                if (! Schema::hasColumn('editals', 'processo')) {
                    $table->string('processo')->nullable()->after('descricao');
                }
                if (! Schema::hasColumn('editals', 'situacao')) {
                    $table->string('situacao')->default('ABERTO')->after('processo');
                }
                if (! Schema::hasColumn('editals', 'created_at')) {
                    $table->timestamps();
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('editals')) {
            Schema::table('editals', function (Blueprint $table) {
                if (Schema::hasColumn('editals', 'titulo')) {
                    $table->dropColumn('titulo');
                }
                if (Schema::hasColumn('editals', 'descricao')) {
                    $table->dropColumn('descricao');
                }
                if (Schema::hasColumn('editals', 'processo')) {
                    $table->dropColumn('processo');
                }
                if (Schema::hasColumn('editals', 'situacao')) {
                    $table->dropColumn('situacao');
                }
                // não remove timestamps automaticamente para evitar efeitos colaterais
            });
        }
    }
};
