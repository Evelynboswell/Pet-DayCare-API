<?php

namespace App\Services;

use Midtrans\Config;
use Illuminate\Support\Facades\Http;

class MidtransService
{
    public function __construct()
    {
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function createTransaction($booking, $customer)
    {
        $transactionDetails = [
            'order_id' => 'BOOKING-' . $booking->booking_id,
            'gross_amount' => $booking->total_price,
        ];

        $customerDetails = [
            'first_name' => $customer->name,
            'email' => $customer->email,
            'phone' => $customer->phone_number,
        ];

        $itemDetails = [
            [
                'id' => $booking->boarding_id,
                'price' => $booking->total_price,
                'quantity' => 1,
                'name' => $booking->boardings->boarding_name,
            ],
        ];

        $params = [
            'transaction_details' => $transactionDetails,
            'customer_details' => $customerDetails,
            'item_details' => $itemDetails,
            // Include `enabled_payments` since we're using Snap
            'enabled_payments' => ['gopay', 'bank_transfer', 'credit_card', 'shopeepay'],
        ];

        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . base64_encode(Config::$serverKey . ':'),
        ])->withoutVerifying()->post(
            Config::$isProduction
                ? 'https://app.midtrans.com/snap/v1/transactions'
                : 'https://app.sandbox.midtrans.com/snap/v1/transactions',
            $params
        );

        if ($response->failed()) {
            throw new \Exception('CURL Error: ' . $response->body());
        }

        return $response->json();
    }
}
