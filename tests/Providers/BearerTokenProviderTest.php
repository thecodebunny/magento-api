<?php

namespace Thecodebunny\MagentoApi\Tests\Providers;

use Illuminate\Support\Facades\Http;
use Thecodebunny\MagentoApi\Providers\BearerTokenProvider;
use Thecodebunny\MagentoApi\Tests\TestCase;

class BearerTokenProviderTest extends TestCase
{
    /** @test */
    public function it_can_authenticate_requests(): void
    {
        config('magento.token', '::token::');

        $pendingRequest = Http::baseUrl('localhost');

        /** @var BearerTokenProvider $provider */
        $provider = app(BearerTokenProvider::class);
        $provider->authenticate($pendingRequest);

        $options = $pendingRequest->getOptions();

        $authorization = data_get($options, 'headers.Authorization');

        $this->assertEquals($authorization, 'Bearer ::token::');
    }
}
