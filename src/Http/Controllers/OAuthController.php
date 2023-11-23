<?php

namespace Thecodebunny\MagentoApi\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Thecodebunny\MagentoApi\Contracts\OAuth\ManagesKeys;
use Thecodebunny\MagentoApi\Contracts\OAuth\RequestsAccessToken;
use Thecodebunny\MagentoApi\Http\Requests\CallbackRequest;
use Thecodebunny\MagentoApi\Http\Requests\IdentityRequest;
use Symfony\Component\HttpFoundation\Response;

class OAuthController extends Controller
{
    public function callback(CallbackRequest $request, ManagesKeys $contract): Response
    {
        $contract->merge([
            'callback' => $request->validated(),
        ]);

        return response()->json();
    }

    public function identity(IdentityRequest $request, RequestsAccessToken $contract): RedirectResponse
    {
        $contract->request(
            $request->oauth_consumer_key,
        );

        return redirect()->to($request->success_call_back);
    }
}
