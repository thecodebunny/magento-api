<?php

namespace Thecodebunny\MagentoApi\Tests\Http\Middleware;

use Illuminate\Http\Response;
use Thecodebunny\MagentoApi\Http\Middleware\OAuthMiddleware;
use Thecodebunny\MagentoApi\Tests\TestCase;
use Symfony\Component\HttpKernel\Exception\HttpException;

class OAuthMiddlewareTest extends TestCase
{
    /** @test */
    public function it_can_pass(): void
    {
        config()->set('magento.authentication_method', 'oauth');

        /** @var OAuthMiddleware $middleware */
        $middleware = app(OAuthMiddleware::class);

        /** @var Response $response */
        $response = $middleware->handle(request(), function (): Response {
            return response('passed');
        });

        $this->assertEquals('passed', $response->getContent());
    }

    /** @test */
    public function it_can_abort(): void
    {
        $this->expectException(HttpException::class);

        /** @var OAuthMiddleware $middleware */
        $middleware = app(OAuthMiddleware::class);
        $middleware->handle(request(), function (): Response {
            return response('passed');
        });
    }
}
