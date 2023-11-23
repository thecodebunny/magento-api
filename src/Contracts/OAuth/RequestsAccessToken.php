<?php

namespace Thecodebunny\MagentoApi\Contracts\OAuth;

interface RequestsAccessToken
{
    public function request(string $key): void;
}
