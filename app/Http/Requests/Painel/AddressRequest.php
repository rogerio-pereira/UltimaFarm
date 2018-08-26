<?php

namespace App\Http\Requests\Painel;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
            'address_category_id' => 'required|exists:address_categories,id',
            'zipcode' => 'required',
            'street' => 'required',
            'number' => 'required|integer',
            'complement' => 'nullable',
            'neighborhood' => 'required',
            'city' => 'required',
            'state' => 'required|size:2',
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
            'address_category_id.required' => 'O campo "Local" é obrigatório',
            'address_category_id.exists' => 'Local inválida',

            'zipcode.required' => 'O campo "CEP" é obrigatório',

            'street.required' => 'O campo "Rua" é obrigatório',

            'number.required' => 'O campo "Número" é obrigatório',
            'number.integer' => 'O campo "Número" deve ser um número',

            'neighborhood.required' => 'O campo "Bairro" é obrigatório',

            'city.required' => 'O campo "Cidade" é obrigatório',

            'state.required' => 'O campo "Estado" é obrigatório',
        ];
    }
}
