<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('cpf', '\App\Models\Documents\CPF@validate');
        Validator::extend('cnpj', '\App\Models\Documents\CNPJ@validate');
        Validator::extend('cpfcnpj', '\App\Models\Documents\CpfCnpj@validate');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
