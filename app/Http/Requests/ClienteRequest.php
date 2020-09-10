<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteRequest extends FormRequest
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
          'nome.max'=>'Nome deeve ter até 255 caracteres',
          'endereco.required'=>'Preencha o endereço',
          'endereco.max'=>'Email não deve ter mais de 255 caracteres',
          'numero.required'=>'Preencha o número da casa',
          'numero.max'=>'Confirme o número da casa',
          'email.email'=>'Preencha um email válido',
          'email.max'=>'Email não deve ter mais de 255 caracteres'
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
            'nome'=>'required|max:255', 'endereco'=>'required|max:255','numero'=>'required|max:10', 'email'=>'email|max:255'
        ];
    }
}
