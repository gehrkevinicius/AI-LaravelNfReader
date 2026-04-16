<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotaFiscal extends Model
{
    protected $table = 'notas_fiscais';
    protected $fillable = [
        'empresa', 'cnpj', 'inscricao_estadual', 'inscricao_municipal',
        'chave_acesso', 'data_emissao', 'valor_total', 'valor_desconto',
        'categoria', 'serie', 'observacoes', 'cnpj_destinatario',
        'volume', 'peso', 'transportadora',
    ];
    
    public function itens()
    {
        return $this->hasMany(ItemNota::class);
    }
    //
}
