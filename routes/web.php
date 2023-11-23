<?php

use Illuminate\Support\Facades\Route;
use Thecodebunny\MagentoApi\Http\Controllers\OAuthController;

Route::post('callback', [OAuthController::class, 'callback'])
    ->name('magento.oauth.callback');

Route::get('identity', [OAuthController::class, 'identity'])
    ->middleware(config('magento.oauth.middleware'))
    ->name('magento.oauth.identity');
