<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = ["nome","endereco","numero","email", "observacao"];
    
    public function pets()
    {
        return $this->hasMany('App\Pet');
    }
    public function addPet(Pet $pet)
    {
        return $this->pets()->save($pet);
    }
    
    public function telefones()
    {
        return $this->hasMany('App\Telefone');
    }
    public function addTelefone(Telefone $tel)
    {
        return $this->telefones()->save($tel);
    }
    
    public function deletarPets_Telefones()
    {
        foreach($this->pets as $pet)
        {
            $pet->delete();
        }
        foreach($this->telefones as $tel)
        {
            $tel->delete();
        }
        return true;
    }
}
