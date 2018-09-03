<?php

return [
    'client_id' => env('PAYPAL_CLIENT_ID'),
    'secret_id' => env('PAYPAL_SECRET_ID'),

    'settings' => [
        'mode'                      => env('PAYPAL_CLIENT'), //live or sandbox
        'http.ConnectionTimeOut'    => 30, //segundos
        'log.LogEnbale'             => true,
        'log.FileName'              => storage_path().'logs/paypal.log',
        'log.LogLevel'              => 'FINE',
    ]
];