<?php

namespace App\Http\Controllers\Util;

use App\Http\Controllers\Controller;

class DateController extends Controller
{
    const MONTHS = [
        '1' => 'Janeiro',
        '2' => 'Fevereiro',
        '3' => 'Março',
        '4' => 'Abril',
        '5' => 'Maio',
        '6' => 'Junho',
        '7' => 'Julho',
        '8' => 'Agosto',
        '9' => 'Setembro',
        '10' => 'Outubro',
        '11' => 'Novembro',
        '12' => 'Dezembro'
    ];

    /**
     * Retorna o nome do mes
     * @param  [int]    $month [Number of Month]
     * @return [string] [description]
     */
    public static function mesPorExtenso($month)
    {
        return self::MONTHS[$month];
    }
}
