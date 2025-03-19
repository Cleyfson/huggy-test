<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Domain\Repositories\ClientRepositoryInterface;
use App\Infra\Repositories\ClientRepository;
use App\Infra\Services\HuggyService;
use GuzzleHttp\Client;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(HuggyService::class, function ($app) {
            return new HuggyService(
                new Client(),
                config('services.huggy.api_url'),
                config('services.huggy.api_token')
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
