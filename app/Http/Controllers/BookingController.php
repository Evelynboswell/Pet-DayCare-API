<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Dog;
use App\Models\Boarding;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'dog_id' => 'required|exists:dogs,dog_id',
            'boarding_id' => 'required|exists:boardings,boarding_id',
            'booking_date' => 'required|date|after_or_equal:today',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        $boarding = Boarding::findOrFail($validatedData['boarding_id']);

        if ($boarding->current_stock <= 0) {
            return response()->json(['message' => 'No available slots for this boarding service.'], 400);
        }

        $overlappingBooking = Booking::where('dog_id', $validatedData['dog_id'])
            ->where('boarding_id', $validatedData['boarding_id'])
            ->where('booking_date', $validatedData['booking_date'])
            ->where(function ($query) use ($validatedData) {
                $query->whereBetween('start_time', [$validatedData['start_time'], $validatedData['end_time']])
                      ->orWhereBetween('end_time', [$validatedData['start_time'], $validatedData['end_time']])
                      ->orWhere(function ($q) use ($validatedData) {
                          $q->where('start_time', '<=', $validatedData['start_time'])
                            ->where('end_time', '>=', $validatedData['end_time']);
                      });
            })
            ->exists();

        if ($overlappingBooking) {
            return response()->json(['message' => 'This dog already has a booking in the selected time slot.'], 400);
        }

        $totalPrice = $boarding->price;

        $booking = Booking::create([
            'dog_id' => $validatedData['dog_id'],
            'boarding_id' => $validatedData['boarding_id'],
            'booking_date' => $validatedData['booking_date'],
            'start_time' => $validatedData['start_time'],
            'end_time' => $validatedData['end_time'],
            'total_price' => $totalPrice,
            'status' => 'active'
        ]);

        $boarding->decrement('current_stock');

        // Send confirmation message (example - requires WhatsApp integration)
        // WhatsAppNotificationService::send($booking->dog->customer->phone_number, "Booking confirmed for {$booking->dog->name} on {$booking->booking_date}.");

        return response()->json(['message' => 'Booking created successfully.', 'booking' => $booking], 201);
    }

    public function index(Request $request)
    {
        $bookings = Booking::whereHas('dog', function($query) use ($request) {
            $query->where('customer_id', $request->user()->customer_id);
        })->with(['dog', 'boarding'])->get();

        return response()->json($bookings, 200);
    }

    public function show(Request $request, $booking_id)
    {
        $booking = Booking::where('booking_id', $booking_id)
            ->whereHas('dog', function($query) use ($request) {
                $query->where('customer_id', $request->user()->customer_id);
            })
            ->with(['dog', 'boarding'])
            ->firstOrFail();

        return response()->json($booking, 200);
    }

    public function destroy(Request $request, $booking_id)
    {
        $booking = Booking::where('booking_id', $booking_id)
            ->whereHas('dog', function($query) use ($request) {
                $query->where('customer_id', $request->user()->customer_id);
            })
            ->firstOrFail();

        $booking->update(['status' => 'cancelled']);

        $booking->boarding->increment('current_stock');

        // Send cancellation message (optional)
        // WhatsAppNotificationService::send($booking->dog->customer->phone_number, "Your booking for {$booking->dog->name} has been cancelled.");

        return response()->json(['message' => 'Booking cancelled successfully.'], 200);
    }
}
