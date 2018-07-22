<?php

namespace App\Http\Requests\Painel\User;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirmation',
            'confirmation' => 'required',
            'role' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo "Nome" é obrigatório',
            'name.max' => 'O campo "Nome" não deve ser maior do que :max caracteres',

            'email.required' => 'O campo "E-mail" é obrigatório',
            'email.email' => 'E-mail inválido',
            'email.unique' => 'E-mail já cadastrado',

            'password.required' => 'O campo "Senha" é obrigatório',
            'password.same' => 'O campo "Senha" deve ser igual ao campo "Confirmação de senha"',

            'confirmation.required' => 'O campo "Confirmação de Senha" é obrigatório',

            'confirmation.required' => 'O campo "Perfil" é obrigatório',
        ];
    }
}
