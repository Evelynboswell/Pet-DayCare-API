<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WhatsAppNotificationService
{
    protected $apiUrl = 'https://api.fonnte.com/send';
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('UEwrMacTPxf167ykGu7R');
    }

    public static function send($phoneNumber, $message)
    {
        $apiKey = env('UEwrMacTPxf167ykGu7R');
        $response = Http::withHeaders([
            'Authorization' => $apiKey,
        ])->post('https://api.fonnte.com/send', [
            'phone' => $phoneNumber,
            'message' => $message,
            'type' => 'text',
        ]);

        return $response->successful();
    }
}
