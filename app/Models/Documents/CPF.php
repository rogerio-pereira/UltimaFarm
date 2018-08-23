<?php

namespace App\Models\Documents;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class CPF extends Validator
{
    public $cpf;

    public static function validate($field, $value, $parameters)
    {
        $cpf = self::correctString($value);

        if(strlen($cpf) == 11)
            if(self::isNotSequence($cpf))
                if(self::verifyFirstDigit($cpf))
                    if(self::verifySecondDigit($cpf))
                        return true;

        return false;
    }

    /**
     * Remove dots and dashes
     * @param  $value String to be corrected
     * @return String corrected
     */
    private static function correctString($value)
    {
        $string = $value;
        $string = str_replace('.', '', $string);
        $string = str_replace('-', '', $string);

        return $string;
    }

    /**
     * Verify if CPF is a sequence
     * @param  $cpf Current CPF
     * @return boolean is sequence?
     */
    private static function isNotSequence($cpf)
    {
        for($i=0; $i<10; $i++)
            if($cpf == str_repeat($i, 11))
                return false;

        return true;
    }

    /**
     * Verify if CPF's First Digit is valid
     * @param  $cpf Current CPF
     * @return boolean is First Digit Valid?
     */
    private static function verifyFirstDigit($cpf)
    {
        $sum = 0;

        for(
                $digito=0, $multiplicador=10; 
                $digito<10; 
                $digito++, $multiplicador--
            ) {
            $sum += substr($cpf, $digito, 1) * $multiplicador;
        }

        $result = $sum % 11;

        if($result < 2)
            $result = 0;
        else 
            $result = 11 - $result;

        if($result == substr($cpf, 9, 1))
            return true;

        return false;
    }

    /**
     * Verify if CPF's Second Digit is valid
     * @param  $cpf Current CPF
     * @return boolean is Second Digit Valid?
     */
    private static function verifySecondDigit($cpf)
    {
        $sum = 0;

        for(
                $digito=0, $multiplicador=11; 
                $digito<10; 
                $digito++, $multiplicador--
            ) {
            $sum += substr($cpf, $digito, 1) * $multiplicador;
        }

        $result = $sum % 11;

        if($result < 2)
            $result = 0;
        else 
            $result = 11 - $result;

        if($result == substr($cpf, 10, 1))
            return true;

        return false;
    }
}