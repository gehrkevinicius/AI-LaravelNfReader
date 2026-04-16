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
        Schema::create('itens_nota', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nota_fiscal_id')->constrained('notas_fiscais');
            $table->string('codigo_sku') ->nullable();
            $table->string('descricao');
            $table->decimal('quantidade', 8, 3) ->nullable(); 
            $table->string('unidade_medida') ->nullable(); 
            $table->string('ncm') ->nullable();
            $table->decimal('valor_unitario', 10, 2);
            $table->decimal('valor_icms', 10, 2) ->nullable();
            $table->decimal('valor_desconto', 10, 2) ->nullable();
            $table->decimal('valor_total', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('itens_nota');
    }
};
