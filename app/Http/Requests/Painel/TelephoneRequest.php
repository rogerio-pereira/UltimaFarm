<?php

namespace App\Http\Requests\Painel;

use Illuminate\Foundation\Http\FormRequest;

class TelephoneRequest extends FormRequest
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
            'description' => 'nullable',
            'telephone' => 'required',
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

            'telephone.required' => 'O campo "Telefone" é obrigatório',
        ];
    }
}
