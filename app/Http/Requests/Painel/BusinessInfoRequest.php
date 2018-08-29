<?php

namespace App\Http\Requests\Painel;

use Illuminate\Foundation\Http\FormRequest;

class BusinessInfoRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'companyName' => 'required',
            'cnpj' => 'required|cnpj',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'companyName.required' => 'O campo "Telefone" é obrigatório',

            'cnpj.required' => 'O campo "CNPJ" é obrigatório',
            'cnpj.cnpj' => 'CNPJ inválido',
        ];
    }
}
