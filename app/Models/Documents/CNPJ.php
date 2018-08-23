<?php

namespace App\Models\Documents;

use Illuminate\Database\Eloquent\Model;

class CNPJ extends Model
{
    public $cnpj;

    public static function validate($field, $value, $parameters)
    {
        $cnpj = self::correctString($value);

        if(strlen($cnpj) == 14)
            if(self::isNotSequence($cnpj))
                if(self::verifyFirstDigit($cnpj))
                    if(self::verifySecondDigit($cnpj))
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
        $string = str_replace('/', '', $string);

        return $string;
    }

    /**
     * Verify if cnpj is a sequence
     * @param  $cnpj Current cnpj
     * @return boolean is sequence?
     */
    private static function isNotSequence($cnpj)
    {
        //Não permite CNPJ 00.000.000/000-00
        //for($i=0; $i<10; $i++)
        //Não permite CNPJ 00.000.000/000-00
        for($i=1; $i<10; $i++)
            if($cnpj == str_repeat($i, 14))
                return false;

        return true;
    }

    /**
     * Verify if cnpj's First Digit is valid
     * @param  $cnpj Current cnpj
     * @return boolean is First Digit Valid?
     */
    private static function verifyFirstDigit($cnpj)
    {
        $sum = 0;

        for(
                $digito=0, $multiplicador=5; 
                $digito<12; 
                $digito++, $multiplicador--
            ) {
            if($multiplicador == 1)
                $multiplicador = 9;

            $sum += substr($cnpj, $digito, 1) * $multiplicador;
        }

        $result = $sum % 11;

        if($result < 2)
            $result = 0;
        else 
            $result = 11 - $result;

        if($result == substr($cnpj, 12, 1))
            return true;

        return false;
    }

    /**
     * Verify if cnpj's Second Digit is valid
     * @param  $cnpj Current cnpj
     * @return boolean is Second Digit Valid?
     */
    private static function verifySecondDigit($cnpj)
    {
        $sum = 0;

        for(
                $digito=0, $multiplicador=6; 
                $digito<13; 
                $digito++, $multiplicador--
            ) {
            if($multiplicador == 1)
                $multiplicador = 9;

            $sum += substr($cnpj, $digito, 1) * $multiplicador;
        }

        $result = $sum % 11;

        if($result < 2)
            $result = 0;
        else 
            $result = 11 - $result;

        if($result == substr($cnpj, 13, 1))
            return true;

        return false;
    }
}