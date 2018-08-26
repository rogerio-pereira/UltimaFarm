<?php

namespace App\Http\Requests\Painel;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
            'user.name' => 'required',
            'user.email' => 'required|email|unique:users,email',
            'telephone' => 'required',
            'document' => 'required|unique:clients,document',


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
            'user.name.required' => 'O campo "Nome" é obrigatório',

            'user.email.required' => 'O campo "E-mail" é obrigatório',
            'user.email.email' => 'E-mail inválido',
            'user.email.unique' => 'E-mail já cadastrado',

            'telephone.required' => 'O campo "Telefone" é obrigatório',

            'document.required' => 'O campo "Documento" é obrigatório',
            'document.unique' => 'Documento já cadastrado',


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
