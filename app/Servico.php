<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Servico extends Model
{
    protected $fillable = ['usuario_id', 'cliente_id', 'valor', 'status'];
    
    public function pet($id)
    {
        return \App\Pet::find($id);
    }
    public function servicos_itens()
    {
        return $this->hasMany('App\ItensServicos');
    }
    public function servicos_listas()
    {
        return $this->hasMany('App\ServicosListas', 'id');
    }
    /*public function servicos_listas()
    {
        return $this->hasMany('App\ServicosListas', 'id');
    }*/
    
    public function cliente($id)
    {
        return \App\Cliente::find($id);
    }
    public function forma_de_pagamento()
    {
        return \App\Pagamento::all();
    }
    public function salvar(servicos $servico)
    {
        return $this->servicos()->save($servico);
    }
    
    public function salvar_Servicos()
    {
        return $this->servicos()->save($servico);
    }
    
    public function salvar_Itens_Servicos(ItensServicos $itens_servico)
    {
        return $this->servicos_itens()->save($itens_servico);
    }
}
