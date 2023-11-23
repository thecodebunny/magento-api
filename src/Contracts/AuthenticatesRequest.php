<?php

namespace Thecodebunny\MagentoApi\Contracts;

use Illuminate\Http\Client\PendingRequest;

interface AuthenticatesRequest
{
    public function authenticate(PendingRequest $request): PendingRequest;
}
