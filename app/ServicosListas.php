<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServicosListas extends Model
{
    protected $fillable = ["nome","preco"];
    
    public function servico()
    {
        return $this->belongsTo('App\Servico');
    }
}
