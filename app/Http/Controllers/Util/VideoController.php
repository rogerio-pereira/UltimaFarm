<?php

namespace App\Http\Controllers\Util;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VideoController extends Controller
{
    /**
     * Método isValidYoutubeURL($url)
     * Verifica Validade do Link do Youtube
     * http://stackoverflow.com/questions/10426204/validate-youtube-url-and-it-should-be-exists
     * 06/08/2015 10:34
     * 
     * @param   string  $url    Url a ser verificada
     * @return  boolean         Valido/Invalido
    */
    public static function isValidYoutubeURL($url) 
    {
        // Let's check the host first
        $parse = parse_url($url);
        $host = $parse['host'];
        if (strpos($host, 'youtube.com') == 0) 
            return false;

        $ch = curl_init();
        $oembedURL = 'www.youtube.com/oembed?url=' . $url.'&format=json';
        curl_setopt($ch, CURLOPT_URL, $oembedURL);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            // Silent CURL execution
        $output = curl_exec($ch);
        unset($output);

        $info = curl_getinfo($ch);
        curl_close($ch);

        if ($info['http_code'] !== 404)
            return "1";
        else 
            return "0";
    }

    /**
     * Método getYoutubeId($url)
     * http://stackoverflow.com/questions/6556559/youtube-api-extract-video-id
     * 06/08/2015 12:37
     *
     * @param   string $url Link Youtube
     * @return  string      Youtube video id or FALSE if none found. 
    */
    public static function getYoutubeId($url) 
    {   
        if(strpos($url, '/watch?v=') > 0)
        {
            $url = explode('/watch?v=', $url);
        }
        return $url[1];
    }
}
