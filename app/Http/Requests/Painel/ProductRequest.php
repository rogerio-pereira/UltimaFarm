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
            'quantity' => 'required|integer|min:0',
            'product_category_id' => 'nullable|integer|exists:product_categories,id',
            'product_subcategory_id' => 'nullable|integer|exists:product_subcategories,id',
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

            'quantity.required' => 'O campo "Estoque" é obrigatório',
            'quantity.integer' => 'O campo "Estoque" deve ser um número inteiro',
            'quantity.min' => 'O valor mínimo do campo "Estoque" é :min',

            'product_category_id.integer' => 'O campo "Categoria" deve ser um número inteiro',
            'product_category_id.exists' => 'Categoria inexistente',

            'product_subcategory_id.integer' => 'O campo "Subcategoria" deve ser um número inteiro',
            'product_subcategory_id.exists' => 'Subcategoria inexistente',
        ];
    }
}
