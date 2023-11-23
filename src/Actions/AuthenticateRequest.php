<?php

namespace Thecodebunny\MagentoApi\Actions;

use Illuminate\Http\Client\PendingRequest;
use Thecodebunny\MagentoApi\Contracts\AuthenticatesRequest;
use Thecodebunny\MagentoApi\Enums\AuthenticationMethod;

class AuthenticateRequest implements AuthenticatesRequest
{
    public function authenticate(PendingRequest $request): PendingRequest
    {
        /** @var string $method */
        $method = config('magento.authentication_method');

        $auth = AuthenticationMethod::from($method);

        return $auth->provider()->authenticate($request);
    }

    public static function bind(): void
    {
        app()->singleton(AuthenticatesRequest::class, static::class);
    }
}
