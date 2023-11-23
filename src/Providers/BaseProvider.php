<?php

namespace Thecodebunny\MagentoApi\Providers;

use Illuminate\Http\Client\PendingRequest;

abstract class BaseProvider
{
    abstract public function authenticate(PendingRequest $request): PendingRequest;
}
