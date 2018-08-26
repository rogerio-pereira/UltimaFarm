<?php

namespace App\Http\Requests\Painel\Investor;

use Illuminate\Foundation\Http\FormRequest;

class SaleRequest extends FormRequest
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
            'product_id' => 'required|integer|exists:products,id',
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
            'product_id.required' => 'O campo "Produto" é obrigatório',
            'product_id.integer' => 'O campo "Produto" deve ser um número inteiro',
            'product_id.exists' => 'Produto não existe',
        ];
    }
}
