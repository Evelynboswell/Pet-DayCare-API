<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Booking;
use Carbon\Carbon;
use App\Services\WhatsAppNotificationService;

class UpdateBookingStatus extends Command
{
    protected $signature = 'booking:update-status';
    protected $description = 'Update booking statuses and send reminders for upcoming and expired bookings';

    public function handle()
    {
        $now = Carbon::now();
        $upcomingThreshold = $now->copy()->addHour();

        $upcomingBookings = Booking::where('status', 'active')
            ->where('booking_date', $now->toDateString())
            ->whereBetween('end_time', [$now->toTimeString(), $upcomingThreshold->toTimeString()])
            ->with('dog.customer')
            ->get();

        foreach ($upcomingBookings as $booking) {
            $customer = $booking->dog->customer;
            $message = "Reminder: Your booking for {$booking->dog->name} ends soon at {$booking->end_time}.";
            WhatsAppNotificationService::send($customer->phone_number, $message);
        }

        Booking::where('status', 'active')
            ->where(function ($query) use ($now) {
                $query->where('booking_date', '<', $now->toDateString())
                      ->orWhere(function ($q) use ($now) {
                          $q->where('booking_date', '=', $now->toDateString())
                            ->where('end_time', '<=', $now->toTimeString());
                      });
            })
            ->update(['status' => 'expired']);

        $this->info('Booking statuses updated and reminders sent successfully.');
    }
}
