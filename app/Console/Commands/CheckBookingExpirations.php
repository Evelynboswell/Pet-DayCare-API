<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Booking;
use App\Models\Boarding;
use Carbon\Carbon;

class CheckBookingExpirations extends Command
{
    protected $signature = 'bookings:check-expirations';
    protected $description = 'Check for expired bookings and release resources';

    public function handle()
    {
        $now = Carbon::now();

        // Check bookings that have ended
        $expiredBookings = Booking::where('status', 'active')
        ->where(function ($query) use ($now) {
            $query->where('booking_date', '<', $now->toDateString())
                  ->orWhere(function ($q) use ($now) {
                      $q->where('booking_date', $now->toDateString())
                        ->where('end_time', '<=', $now->toTimeString());
                  });
        })
        ->whereBetween('booking_date', [
            Carbon::now()->subDays(1)->toDateString(),
            Carbon::now()->addDays(1)->toDateString(),
        ])
        ->get();

        foreach ($expiredBookings as $booking) {
            // Restore the boarding stock
            $boarding = Boarding::find($booking->boarding_id);

            if ($boarding) {
                $boarding->increment('current_stock');
            }

            // Mark the booking as expired
            $booking->update(['status' => 'expired']);
        }

        $this->info('Hourly expired booking check completed successfully.');
    }
}
