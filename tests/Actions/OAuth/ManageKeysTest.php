<?php

namespace Thecodebunny\MagentoApi\Tests\Client;

use Illuminate\Support\Facades\Storage;
use Thecodebunny\MagentoApi\Actions\OAuth\ManageKeys;
use Thecodebunny\MagentoApi\Tests\TestCase;

class ManageKeysTest extends TestCase
{
    /** @test */
    public function it_can_get_data(): void
    {
        Storage::fake();

        $content = [
            'key' => 'value',
        ];

        /** @var string $encoded */
        $encoded = json_encode($content);

        Storage::disk('local')->put('secret/magento2_oauth.json', $encoded);

        /** @var ManageKeys $action */
        $action = app(ManageKeys::class);

        $data = $action->get();

        $this->assertEquals($content, $data);
    }

    /** @test */
    public function it_can_set_data(): void
    {
        Storage::fake();

        $content = [
            'key' => 'value',
        ];

        /** @var ManageKeys $action */
        $action = app(ManageKeys::class);
        $action->set($content);

        $data = $action->get();

        $this->assertEquals($content, $data);
    }

    /** @test */
    public function it_can_merge_data(): void
    {
        Storage::fake();

        $content = [
            'key' => 'value',
        ];

        /** @var string $encoded */
        $encoded = json_encode($content);

        Storage::disk('local')->put('secret/magento2_oauth.json', $encoded);

        $new = [
            'something' => 'else',
        ];

        /** @var ManageKeys $action */
        $action = app(ManageKeys::class);
        $action->merge($new);

        $data = $action->get();

        $this->assertEquals(array_merge($content, $new), $data);
    }
}
