<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Boarding;
use Illuminate\Http\Request;
use App\Models\Dog;
use App\Services\FonnteService;
use App\Services\MidtransService;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function store(Request $request, FonnteService $fonnteService, MidtransService $midtransService)
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

        $customer = $dog->customer;

        $snapToken = $midtransService->createTransaction($booking, $customer);

        if (!isset($snapToken['redirect_url'])) {
            throw new \Exception('Midtrans did not return a payment link.');
        }

        $paymentLink = $snapToken['redirect_url'];

        $message = "Hello, {$customer->name}! Your booking for {$dog->name} has been created. Please complete the payment using this link: {$paymentLink}";
        $fonnteService->sendMessage($customer->phone_number, $message);

        $upcomingMessage = "Hello, {$customer->name}!
Dont forget {$dog->name}'s appointment for:
🐾: {$boarding->boarding_name}
📆: {$booking->booking_date}
⏰: {$booking->start_time}

We'll see you soon!
With so much LOVE and CARE, DoggoCare ❤";

        $endingMessage = "Hello, {$customer->name}!
{$dog->name}'s appointment for {$boarding->boarding_name} is going to end in 15 minutes!

Thank you for choosing our services!
With so much LOVE and CARE, DoggoCare ❤";

        $startTimestamp = strtotime("{$booking->booking_date} {$booking->start_time}");
        $endTimestamp = strtotime("{$booking->booking_date} {$booking->end_time}");

        $reminderBeforeStart = $startTimestamp - 3600; // 1 hour before start
        $reminderBeforeEnd = $endTimestamp - 900; // 15 minutes before end

        $fonnteService->sendMessage($customer->phone_number, $upcomingMessage, $reminderBeforeStart);
        $fonnteService->sendMessage($customer->phone_number, $endingMessage, $reminderBeforeEnd);

        return response()->json(['message' => 'Booking created successfully. Payment link sent.', 'payment_link' => $paymentLink, 'booking' => $booking], 201);
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
