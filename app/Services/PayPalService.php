<?php

namespace App\Services;

use App\Models\BookingAppointment;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class PayPalService
{
    public function createOrder(BookingAppointment $appointment, float $amountUsd, string $returnUrl, string $cancelUrl): array
    {
        $bookingCode = $appointment->booking_code;

        $response = $this->client()->post('/v2/checkout/orders', [
            'intent' => 'CAPTURE',
            'purchase_units' => [
                [
                    'reference_id' => (string) $appointment->id,
                    'custom_id' => $bookingCode,
                    'description' => 'LegalEase appointment ' . $bookingCode,
                    'amount' => [
                        'currency_code' => $this->currency(),
                        'value' => number_format($amountUsd, 2, '.', ''),
                    ],
                ],
            ],
            'payment_source' => [
                'paypal' => [
                    'experience_context' => [
                        'payment_method_preference' => 'IMMEDIATE_PAYMENT_REQUIRED',
                        'brand_name' => config('app.name', 'LegalEase'),
                        'locale' => 'en-US',
                        'landing_page' => 'LOGIN',
                        'shipping_preference' => 'NO_SHIPPING',
                        'user_action' => 'PAY_NOW',
                        'return_url' => $returnUrl,
                        'cancel_url' => $cancelUrl,
                    ],
                ],
            ],
        ]);

        if ($response->failed()) {
            throw new RuntimeException('PayPal create order failed: ' . $response->body());
        }

        $payload = $response->json();
        $approveUrl = collect($payload['links'] ?? [])->firstWhere('rel', 'payer-action')['href']
            ?? collect($payload['links'] ?? [])->firstWhere('rel', 'approve')['href']
            ?? null;

        if (! $approveUrl) {
            throw new RuntimeException('PayPal did not return an approval URL.');
        }

        return [
            'id' => $payload['id'] ?? null,
            'status' => $payload['status'] ?? null,
            'approve_url' => $approveUrl,
            'payload' => $payload,
        ];
    }

    public function captureOrder(string $orderId): array
    {
        $response = $this->client()->post("/v2/checkout/orders/{$orderId}/capture", []);

        if ($response->failed()) {
            throw new RuntimeException('PayPal capture order failed: ' . $response->body());
        }

        return $response->json();
    }

    public function amountForPaypal(float $amountVnd): float
    {
        $rate = (float) config('services.paypal.exchange_rate', 25000);

        if ($rate <= 0) {
            throw new RuntimeException('PAYPAL_EXCHANGE_RATE must be greater than zero.');
        }

        return round($amountVnd / $rate, 2);
    }

    public function currency(): string
    {
        return strtoupper((string) config('services.paypal.currency', 'USD'));
    }

    private function client(): PendingRequest
    {
        return Http::baseUrl($this->baseUrl())
            ->acceptJson()
            ->withToken($this->accessToken());
    }

    private function accessToken(): string
    {
        $clientId = config('services.paypal.client_id');
        $secret = config('services.paypal.client_secret');

        if (! $clientId || ! $secret) {
            throw new RuntimeException('Missing PayPal credentials.');
        }

        $response = Http::baseUrl($this->baseUrl())
            ->asForm()
            ->withBasicAuth($clientId, $secret)
            ->post('/v1/oauth2/token', [
                'grant_type' => 'client_credentials',
            ]);

        if ($response->failed()) {
            throw new RuntimeException('PayPal authentication failed: ' . $response->body());
        }

        return (string) $response->json('access_token');
    }

    private function baseUrl(): string
    {
        return config('services.paypal.mode') === 'live'
            ? 'https://api-m.paypal.com'
            : 'https://api-m.sandbox.paypal.com';
    }
}
