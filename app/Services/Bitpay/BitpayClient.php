<?php

namespace App\Services\Bitpay;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

/**
 * BitPay client using HTTP API. Uses token-based requests when configured.
 * - If `laravel-bitpay.enabled` is falsy, the client returns safe stubs.
 * - If `token` is provided in config, the client will attempt real API calls.
 *
 * Note: Full webhook signature verification using BitPay public keys requires
 * the bitpay key-utils package; for now this implements an optional
 * HMAC-style secret check (if `webhook_secret` set) or returns true.
 */
class BitpayClient
{
    protected array $config;
    protected GuzzleClient $http;

    public function __construct(array $config = [])
    {
        $this->config = $config;
        $base = Arr::get($config, 'base_uri');
        if (! $base) {
            $network = Arr::get($config, 'network', 'testnet');
            $base = $network === 'livenet' ? 'https://bitpay.com' : 'https://test.bitpay.com';
        }

        $this->http = new GuzzleClient([
            'base_uri' => $base,
            'timeout' => 10,
        ]);
    }

    public function enabled(): bool
    {
        return (bool) Arr::get($this->config, 'enabled', false);
    }

    protected function token(): ?string
    {
        return Arr::get($this->config, 'token') ?: null;
    }

    /**
     * Create an invoice via BitPay REST API (token-based) or return a stub when disabled.
     * $payload is forwarded to BitPay's /invoices endpoint.
     */
    public function createInvoice(array $payload): array
    {
        if (! $this->enabled() || ! $this->token()) {
            return [
                'id' => 'stub-invoice-'.uniqid(),
                'url' => url('/payments/bitpay/invoice/'.uniqid()),
                'status' => 'new',
                'data' => $payload,
            ];
        }

        try {
            $response = $this->http->post('/invoices', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer '.$this->token(),
                ],
                'json' => $payload,
            ]);

            $body = json_decode((string) $response->getBody(), true);
            return is_array($body) ? $body : ['data' => $body];
        } catch (RequestException $e) {
            Log::warning('BitPay createInvoice failed: '.$e->getMessage());
            // fallback stub so app flows don't break
            return [
                'id' => 'error-invoice-'.uniqid(),
                'url' => null,
                'status' => 'error',
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Verify incoming webhook. If `webhook_secret` is set, use HMAC-SHA256.
     * For BitPay's real identity-based signatures, a proper verifier is required.
     */
    public function verifyWebhook(string $rawPayload, array $headers = []): bool
    {
        $secret = Arr::get($this->config, 'webhook_secret');
        if ($secret) {
            $sig = $headers['x-signature'] ?? $headers['X-Signature'] ?? null;
            if (! $sig) {
                Log::warning('Missing webhook signature header');
                return false;
            }

            $calc = hash_hmac('sha256', $rawPayload, $secret);
            return hash_equals($calc, $sig);
        }

        // If no secret provided, accept but log for visibility
        Log::warning('Webhook verification skipped: no webhook_secret configured');
        return true;
    }
}

