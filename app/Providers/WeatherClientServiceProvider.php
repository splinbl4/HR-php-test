<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class WeatherClientServiceProvider
 * @package App\Providers
 */
class WeatherClientServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            'App\Module\Weather\Service\WeatherClientInterface',
            'App\Module\Weather\Service\WeatherYandexClient'
        );
    }
}
