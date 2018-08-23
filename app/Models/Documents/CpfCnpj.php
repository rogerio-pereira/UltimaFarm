<?php

namespace App\Models\Documents;

use Illuminate\Database\Eloquent\Model;

class CpfCnpj extends Model
{
    public $cpfCnpj;

    public static function validate($field, $value, $parameters)
    {
        $cpfValidation = CPF::validate($field, $value, $parameters);
        $cnpjValidation = CNPJ::validate($field, $value, $parameters);

        return $cpfValidation OR $cnpjValidation;
    }
}
