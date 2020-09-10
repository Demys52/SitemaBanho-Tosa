<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TelefoneRequest extends FormRequest
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
          'contato.required'=>'Preencha um nome',
          'contato.max'=>'Nome deve ter até 255 caracteres',
          'telefone.required'=>'Preencha o telefone'
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
            'contato'=>'required|max:255', 'telefone'=>'required'
        ];
    }
}
