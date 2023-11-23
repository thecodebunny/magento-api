<?php

namespace Thecodebunny\MagentoApi\Enums;

use Thecodebunny\MagentoApi\Providers\BaseProvider;
use Thecodebunny\MagentoApi\Providers\BearerTokenProvider;
use Thecodebunny\MagentoApi\Providers\OAuthProvider;

enum AuthenticationMethod: string
{
    case Token = 'token';
    case OAuth = 'oauth';

    public function provider(): BaseProvider
    {
        $class = match ($this) {
            AuthenticationMethod::Token => BearerTokenProvider::class,
            AuthenticationMethod::OAuth => OAuthProvider::class,
        };

        /** @var BaseProvider $instance */
        $instance = app($class);

        return $instance;
    }
}
