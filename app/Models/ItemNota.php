<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemNota extends Model
{
    protected $table = 'itens_nota';
    protected $attributes = [
    'ncm' => 'N/A',
    'codigo_sku' => 'N/A',
    'unidade_medida' => 'UN',
    'valor_icms' => 0,
    'valor_desconto' => 0,
    ];
    protected $fillable = [
        'nota_fiscal_id', 'codigo_sku', 'descricao', 'quantidade',
        'unidade_medida', 'ncm', 'valor_unitario', 'valor_icms',
        'valor_desconto', 'valor_total'
    ];
    
    public function notaFiscal()
    {
        return $this->belongsTo(NotaFiscal::class);
    }
    //
}
