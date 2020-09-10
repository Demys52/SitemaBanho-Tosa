<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItensServicos extends Model
{
    protected $fillable = ["servico_id","pet_id","item_servico","quantidade","valor_unidade","valor_desconto","valor_total"];
    
    public function servico()
    {
        return $this->belongsTo('App\Servico');
    }
    
    public function servicos_listas()
    {
        return $this->hasMany('App\ServicosListas');
    }
}
