<?php

namespace App\Http\Requests;

use App\Models\Enums\Books\FileType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BookPostAndPutRequest extends FormRequest
{
    use ConvertResponseToJson;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:60'],
            'author' => ['required', 'string', 'max:256'],
            'file_type' => [
                'required',
                'string',
                Rule::in([FileType::Physical, FileType::Digital]),
            ],
            'categories_id' => [
                'required',
                'exists:App\Models\Category,id'
            ],
            'size_or_weight' => [
                'required',
                'numeric',
            ]
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Informe o nome do livro.',
            'name.max' => 'O nome do livro deve ter no máximo 60 caracteres.',
            'author.required' => 'Informe o autor do livro.',
            'author.max' => 'O nome do autor do livro deve ter no máximo 60 caracteres.',
            'file_type.required' => 'Informe o tipo de arquivo.',
            'file_type.in' => 'Tipo de arquivo inválido.',
            'categories_id.required' => 'Informe a categoria do livro.',
            'categories_id.exists' => 'Categoria inválida.',
            'size_or_weight.required' => $this->file_type === FileType::Digital ? 'Informe o tamanho do arquivo.' : 'Informe o peso do livro.',
            'size_or_weight.numeric' => $this->file_type === FileType::Digital ? 'Tamanho do arquivo não é um número válido.' : 'Peso do livro não é um número válido.',
        ];
    }
}
