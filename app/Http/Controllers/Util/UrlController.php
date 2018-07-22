<?php

namespace App\Http\Controllers\Util;

use App\Http\Controllers\Controller;

class UrlController extends Controller
{
    /**
     * Transforma a string do parametro para um formato de URL Amigavel
     * 
     * @access  public
     * @param   string $string  String a ser convertida em URL Amigável
     * @return  string          Url Amigavel
    */
    public static function friendlyUrl($string)
    {
        $urlAmigavel    = $string;
        $urlAmigavel    = str_replace("\n",     '',     $urlAmigavel);
        $urlAmigavel    = str_replace(',',      '',     $urlAmigavel);
        $urlAmigavel    = str_replace('-',      '',     $urlAmigavel);
        $urlAmigavel    = str_replace('.',      '-',    $urlAmigavel);
        $urlAmigavel    = str_replace(' ',      '-',    $urlAmigavel);
        $urlAmigavel    = str_replace('--',     '-',    $urlAmigavel);
        $urlAmigavel    = urlencode($urlAmigavel);

            //Tira caracteres Especiaiss
        setlocale(LC_ALL, 'en_US.UTF8');
        $urlAmigavel = iconv('UTF-8',                         'ASCII//TRANSLIT',    $urlAmigavel);
        $urlAmigavel = preg_replace("/[^a-zA-Z0-9\/_%| -]/",  '',                   $urlAmigavel);
        $urlAmigavel = preg_replace("/[\/| -]+/",             '-',                  $urlAmigavel);

        return $urlAmigavel;
    }

    /**
     * Corrige a url amigavel para um formato que pode ser entendido
     * 
     * @access  public
     * @param   string $urlAmigavel     URL amigavel
     * @return  string                  Texto corrigido
     * @since   1.1
    */
    public static function translateFriendlyUrl($urlAmigavel)
    {
        $string = str_replace('-', ' ', $urlAmigavel);
        $string = str_replace('_', ' - ', $string);

        return $string;
    }

    /**
     * Método unshorten_url($url)
     * Desencurta a URL
     * 
     * @since 1.1
     * @access  public
     * @param   string $url Url a ser desencurtada
     * @return  string      Url Desencurtada
    */
    public static function unshorten_url($url) 
    {
        $ch = curl_init($url);
        curl_setopt_array($ch, array(
                                        CURLOPT_FOLLOWLOCATION => TRUE,  // the magic sauce
                                        CURLOPT_RETURNTRANSFER => TRUE,
                                        CURLOPT_SSL_VERIFYHOST => FALSE, // suppress certain SSL errors
                                        CURLOPT_SSL_VERIFYPEER => FALSE,
                                    ));
        curl_exec($ch);
        $url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
        curl_close($ch);

        return $url;
    }
}
