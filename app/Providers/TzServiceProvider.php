<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\TzController;
use GuzzleHttp\Client;

class TzServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(TzController::class, function ($app) {
            $options = [
                'api_key' => env('MPESA_API_KEY'),
                'public_key' => env('MPESA_PUBLIC_KEY'),
                'client_options' => [],
                'persistent_session' => false,
                'service_provider_code' => env('MPESA_SERVICE_PROVIDER_CODE'),
                'country' => 'TZN',
                'currency' => 'TZS',
                'env' => env('MPESA_ENV', 'sandbox'),
            ];

            return new TzController($options, new Client());
        });
    }

    public function boot()
    {
        //
    }
}
