<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServicoRequest extends FormRequest
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
          'pet_id.numeric'=>'Informe o Pet que será atendido',
          'servico_id.*.numeric'=>'Algo errado, atualize e tente novamente',
          'servico_id.*.max'=>'Algo errado na id do serviço, atualize e tente novamente',
          'quantidade.*required'=>'Informe a quantidade',
          'valor.*required'=>'Informe o valor do serviço',
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
            'pet_id'=>'numeric', 'servico_id[]'=>'numeric|max:1', 'quantidade.*'=>'required', 'valor.*'=>'required'
        ];
    }
}
