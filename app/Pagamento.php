<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pagamento extends Model
{
    protected $fillable = ["id_servico","id_formadepagamento","parcela","valor"];
    
    public function servico()
    {
        return $this->belongsTo('App\Servico');
    }
    public function formasdepagamento()
    {
        return $this->belongsTo('App\Formasdepagamentos');
    }
}
