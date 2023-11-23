<?php

namespace Thecodebunny\MagentoApi\Tests;

use Thecodebunny\MagentoApi\Client\Magento;
use Thecodebunny\MagentoApi\ServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            ServiceProvider::class,
        ];
    }

    protected function defineEnvironment($app): void
    {
        Magento::fake();
    }
}
