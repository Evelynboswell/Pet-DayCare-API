<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'booking';
    protected $primaryKey = 'booking_id';
    protected $keyType = 'string';
    public $incrementing = false;
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($booking) {
            $latestBooking = static::latest('booking_id')->first();

            if (!$latestBooking) {
                $nextIdNumber = 1;
            } else {
                $lastId = (int) str_replace('BKG', '', $latestBooking->booking_id);
                $nextIdNumber = $lastId + 1;
            }

            $booking->booking_id = 'BKG' . $nextIdNumber;
        });
    }
    protected $fillable = [
        'dog_id',
        'boarding_id',
        'booking_date',
        'total_price'
    ];
    protected $dates = [
        'booking_date'
    ];
    public function customer()
    {
        return $this->hasOneThrough(
            User::class,
            Dog::class,
            'dog_id',
            'customer_id',
            'dog_id',
            'customer_id'
        );
    }

    public function dog()
    {
        return $this->belongsTo(Dog::class, 'dog_id', 'dog_id');
    }
}
