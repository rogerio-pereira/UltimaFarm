<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Cache;

class GetDolar
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Cache::get('dolar') == null) {
            $dolar = $this->getDolar();

            $expiresAt = Carbon::now()->addDays(1);

            Cache::put('dolar', $dolar, $expiresAt);
        }

        return $next($request);
    }

    private function getDolar()
    {
        $curl = curl_init();
        /*curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'https://api.promasters.net.br/cotacao/v1/valores',
            CURLOPT_USERAGENT => 'Codular Sample cURL Request'
        ));*/

        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'http://economia.awesomeapi.com.br/USD-BRL/1',
            CURLOPT_USERAGENT => 'Codular Sample cURL Request'
        ));

        $resp = json_decode(curl_exec($curl));

        curl_close($curl);

        //return $resp->valores->USD->valor;
        return $resp[0]->bid;
    }
}
