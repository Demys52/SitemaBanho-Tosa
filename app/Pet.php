<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    protected $fillable = ["nome","raca","porte"];
    public function cliente()
    {
        return $this->belongsTo('App\Cliente');
    }
    public function servico()
    {
        return $this->belongsTo('App\Servico');
    }
}
