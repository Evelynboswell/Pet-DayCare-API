<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class FonnteService
{
    protected $apiKey;
    protected $baseUrl;

    public function __construct()
    {
        $this->apiKey = config('services.fonnte.api_key');
        $this->baseUrl = config('services.fonnte.base_url', 'https://api.fonnte.com/send');
    }

    public function sendMessage($phoneNumber, $message, $schedule = null)
    {
    if (!$this->baseUrl || !$this->apiKey) {
        throw new \Exception('Fonnte API configuration is missing.');
    }

    $payload = [
        'target' => $phoneNumber,
        'message' => $message,
    ];

    if ($schedule) {
        $payload['schedule'] = $schedule;
    }

    $response = Http::withHeaders([
        'Authorization' => $this->apiKey,
    ])->withoutVerifying()->post($this->baseUrl, $payload);

    if ($response->failed()) {
        $errorMessage = $response->body();
        throw new \Exception('Failed to send WhatsApp message: ' . $errorMessage);
    }

    return $response->json();
    }
}
