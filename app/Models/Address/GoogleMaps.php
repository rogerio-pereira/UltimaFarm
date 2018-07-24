<?php

namespace App\Models\Address;

use Illuminate\Database\Eloquent\Model;

class GoogleMaps extends Model
{
    public static function convertAddress($address)
    {
        $address = str_replace(' ', '+', $address);
        $address = str_replace(',', '', $address);
        $address = str_replace('.', '', $address);
        $address = str_replace('-', '', $address);

        return 'https://www.google.com/maps/search/?api=1&query='.$address;
    }
}
