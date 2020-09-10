<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Formasdepagamentos extends Model
{
    public function servico()
    {
        return $this->belongsTo('App\Servico');
    }
}
