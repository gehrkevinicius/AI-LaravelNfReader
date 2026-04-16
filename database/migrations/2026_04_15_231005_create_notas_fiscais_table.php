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
        Schema::create('notas_fiscais', function (Blueprint $table) {
            $table->id();
            $table->string('empresa');
            $table->string('cnpj');
            $table->string('Inscricao_Estadual') ->nullable(); 
            $table->string('Inscricao_Municipal') ->nullable(); 
            $table->string('chave_acesso');
            $table->date('data_emissao');
            $table->decimal('valor_total', 10, 2);
            $table->decimal('valor_desconto', 10, 2) ->nullable();
            $table->string('categoria')->nullable();
            $table->string('serie');
            $table->string('observacoes')->nullable();
            $table->string('cnpj_destinatario')->nullable();
            $table->string('volume', 8, 3)->nullable();
            $table->string('peso', 8, 3)->nullable();
            $table->string('Transportadora')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notas_fiscais');
    }
};
