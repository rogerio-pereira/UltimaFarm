<?php

namespace App\Http\Requests\Painel\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserUpdateRequest extends FormRequest
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
            //'email' => 'required|email|unique:users,email,'.Auth::user()->id,
            'email' => 'required|email',
            'password' => 'same:confirmation',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo "Nome" é obrigatório',
            'name.max' => 'O campo "Nome" não deve ser maior do que :max caracteres',

            'email.required' => 'O campo "E-mail" é obrigatório',
            'email.email' => 'E-mail inválido',
            //'email.unique' => 'E-mail já cadastrado',

            'password.same' => 'O campo "Senha" deve ser igual ao campo "Confirmação de senha"',
        ];
    }
}
