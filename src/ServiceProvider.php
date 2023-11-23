<?php

namespace Thecodebunny\MagentoApi;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Thecodebunny\MagentoApi\Actions\AuthenticateRequest;
use Thecodebunny\MagentoApi\Actions\BuildRequest;
use Thecodebunny\MagentoApi\Actions\OAuth\ManageKeys;
use Thecodebunny\MagentoApi\Actions\OAuth\RequestAccessToken;
use Thecodebunny\MagentoApi\Http\Middleware\OAuthMiddleware;

class ServiceProvider extends BaseServiceProvider
{
    public function register(): void
    {
        $this
            ->registerConfig()
            ->registerActions();
    }

    protected function registerConfig(): static
    {
        $this->mergeConfigFrom(__DIR__.'/../config/magento.php', 'magento');

        return $this;
    }

    protected function registerActions(): static
    {
        ManageKeys::bind();
        RequestAccessToken::bind();
        AuthenticateRequest::bind();
        BuildRequest::bind();

        return $this;
    }

    public function boot(): void
    {
        $this
            ->bootConfig()
            ->bootRoutes();
    }

    protected function bootConfig(): static
    {
        $this->publishes([
            __DIR__.'/../config/magento.php' => config_path('magento.php'),
        ], 'config');

        return $this;
    }

    protected function bootRoutes(): static
    {
        if (! $this->app->routesAreCached()) {
            Route::prefix(config('magento.oauth.prefix'))
                ->middleware([OAuthMiddleware::class])
                ->group(__DIR__.'/../routes/web.php');
        }

        return $this;
    }
}
