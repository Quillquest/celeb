<?php

namespace Tests\Unit;

use App\Services\Bitpay\BitpayClient;
use Tests\TestCase;

class BitpayClientTest extends TestCase
{
    public function test_create_invoice_returns_stub_when_disabled()
    {
        $client = new BitpayClient(['enabled' => false]);

        $payload = ['amount' => 100, 'currency' => 'USD'];
        $result = $client->createInvoice($payload);

        $this->assertIsArray($result);
        $this->assertArrayHasKey('id', $result);
        $this->assertStringStartsWith('stub-invoice-', $result['id']);
        $this->assertEquals('new', $result['status']);
        $this->assertEquals($payload, $result['data']);
    }

    public function test_verify_webhook_with_secret_valid_and_invalid()
    {
        $secret = 'test-secret-abc';
        $client = new BitpayClient(['webhook_secret' => $secret]);

        $raw = '{"event":"invoice","id":"123"}';
        $sig = hash_hmac('sha256', $raw, $secret);

        $this->assertTrue($client->verifyWebhook($raw, ['x-signature' => $sig]));
        $this->assertFalse($client->verifyWebhook($raw, ['x-signature' => 'invalid']));
    }
}
