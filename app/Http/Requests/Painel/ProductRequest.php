<?php

namespace App\Http\Requests\Painel;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required|max:100',
            'price' => 'required',

            'deadline' => 'required|integer|min:1',
            'profitability' => 'required|numeric|min:1',
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
            'name.required' => 'O campo "Nome" é obrigatório',
            'name.max' => 'O campo "Nome" não deve ser maior do que :max caracteres',

            'price.required' => 'O campo "Valor" é obrigatório',

            'deadline.required' => 'O campo "Prazo de Retirada" é obrigatório',
            'deadline.integer' => 'O campo "Prazo de Retirada" deve ser um número inteiro',
            'deadline.min' => 'O campo "Prazo de Retirada" deve ser de no mínimo :min mes(es)',

            'profitability.required' => 'O campo "Rentabilidade" é obrigatório',
            'profitability.numeric' => 'O campo "Rentabilidade" deve ser um número',
            'profitability.required' => 'O campo "Rentabilidade" deve ser de no mínimo :min%',
        ];
    }
}
