<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LivrosRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // Form - Response -  Formulario  do Responsavel
            'titulo'=>'required|min:3|max:191',
            'autor'=>'required|min:3|max:191',
            'tipo'=>'required|min:1|max:1',
            'document'=>'required|min:11|max:14|',
            'editora'=>'required|min:5|max:20',
            'ano'=>'required',
            'paginas'=>'required',
            'descricao'=>'required',
          
            'id_categoria'=>'required|min:1:max:1 ',

        ];
}
}
