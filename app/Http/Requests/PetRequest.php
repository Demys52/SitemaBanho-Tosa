<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return
        [
          'nome.required'=>'Preencha um nome',
          'nome.max'=>'Nome deve ter até 255 caracteres',
          'raca.required'=>'Informe a raça ou SRD',
          'raca.max'=>'Raça jamais conterá mais de 255 caracteres',
          'porte.required'=>'Informe o porte da raça. Ex.:Pequeno, Medio, Grande, Gigante',
          'porte.max'=>'Infome o porte. Ex.:Pequeno, Medio, Grande, Gigante',
        ];
    }
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nome'=>'required|max:255',
            'raca'=>'required|max:255',
            'porte'=>'required|max:255'
        ];
    }
}
