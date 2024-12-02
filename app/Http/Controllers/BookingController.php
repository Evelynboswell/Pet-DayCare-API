<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Boarding;
use Illuminate\Http\Request;
use App\Models\Dog;
use App\Services\FonnteService;
use Carbon\Carbon;
use Midtrans\Config;
use Midtrans\Snap;

class BookingController extends Controller
{
    public function __construct()
    {
        // Midtrans configuration
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        \Midtrans\Config::$curlOptions = [
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
        ];
    }
    public function store(Request $request, FonnteService $fonnteService)
    {
        $validatedData = $request->validate([
            'dog_id' => 'required|exists:dogs,dog_id',
            'boarding_id' => 'required|exists:boardings,boarding_id',
            'booking_date' => 'required|date|after_or_equal:today',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        $dog = Dog::with('customer')->find($validatedData['dog_id']);
        if (!$dog || !$dog->customer) {
            return response()->json(['message' => 'Dog or associated customer not found.'], 404);
        }

        $boarding = Boarding::findOrFail($validatedData['boarding_id']);
        if ($boarding->current_stock <= 0) {
            return response()->json(['message' => 'No available slots for this boarding service.'], 400);
        }

        $totalPrice = $boarding->price;

        $booking = Booking::create([
            'dog_id' => $validatedData['dog_id'],
            'boarding_id' => $validatedData['boarding_id'],
            'booking_date' => $validatedData['booking_date'],
            'start_time' => $validatedData['start_time'],
            'end_time' => $validatedData['end_time'],
            'total_price' => $totalPrice,
        ]);

        $boarding->decrement('current_stock');

        $customerName = $dog->customer->name;
        $customerPhone = $dog->customer->phone_number;
        $customerEmail = $dog->customer->email;
        $dogName = $dog->name;
        $boardingName = $boarding->boarding_name;

        $params = [
            'transaction_details' => [
                'order_id' => 'BOOK-' . $booking->booking_id,
                'gross_amount' => $totalPrice,
            ],
            'customer_details' => [
                'first_name' => $customerName,
                'email' => $customerEmail,
                'phone' => $customerPhone,
            ],
            'item_details' => [
            [
                'id' => 'boarding-' . $boarding->boarding_id,
                'price' => $totalPrice,
                'quantity' => 1,
                'name' => $boardingName,
            ]
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to create payment link.', 'error' => $e->getMessage()], 500);
        }

        $upcomingMessage = "Hello, {$customerName}!
    Dont forget {$dogName}'s appointment for:
    🐾: {$boardingName}
    📆: {$booking->booking_date}
    ⏰: {$booking->start_time}

    We'll see you soon!
    With so much LOVE and CARE, DoggoCare ❤";

        $endingMessage = "Hello, {$customerName}!
    {$dogName}'s appointment for {$boardingName} is going to end in 15 minutes!

    Thank you for choosing our services!
    With so much LOVE and CARE, DoggoCare ❤";

        $startTimestamp = strtotime("{$booking->booking_date} {$booking->start_time}");
        $endTimestamp = strtotime("{$booking->booking_date} {$booking->end_time}");

        $reminderBeforeStart = $startTimestamp - 3600; // 1 hour before start
        $reminderBeforeEnd = $endTimestamp - 900; // 15 minutes before end

        $confirmationMessage = "Your booking for {$dogName} on {$booking->booking_date} from {$booking->start_time} to {$booking->end_time} has been confirmed!";
        $fonnteService->sendMessage($customerPhone, $confirmationMessage);

        $fonnteService->sendMessage($customerPhone, $upcomingMessage, $reminderBeforeStart);
        $fonnteService->sendMessage($customerPhone, $endingMessage, $reminderBeforeEnd);

        return response()->json([
            'message' => 'Booking created successfully. Please complete your payment.',
            'booking' => $booking,
            'payment_link' => 'https://app.sandbox.midtrans.com/snap/v2/vtweb/' . $snapToken,
        ], 201);
    }

    public function index(Request $request)
    {
        $bookings = Booking::whereHas('dogs', function ($query) use ($request) {
            $query->where('customer_id', $request->user()->customer_id);
        })->with(['dogs', 'boardings'])->get();

        return response()->json($bookings, 200);
    }

    public function show($booking_id)
    {
        $booking = Booking::where('booking_id', $booking_id)->with(['dogs', 'boardings'])->firstOrFail();

        return response()->json($booking, 200);
    }
}
