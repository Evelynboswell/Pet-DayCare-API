<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';
    protected $primaryKey = 'booking_id';

    protected $fillable = [
        'dog_id',
        'boarding_id',
        'booking_date',
        'start_time',
        'end_time',
        'total_price',
        'status'
    ];

    protected $dates = [
        'booking_date',
    ];

    protected $appends = ['is_active'];

    public function getIsActiveAttribute()
    {
        $endDateTime = Carbon::createFromFormat('Y-m-d H:i', $this->booking_date->format('Y-m-d') . ' ' . $this->end_time);
        return Carbon::now()->lessThanOrEqualTo($endDateTime) && $this->status === 'active';
    }

    public function dog()
    {
        return $this->belongsTo(Dog::class, 'dog_id', 'dog_id');
    }

    public function boarding()
    {
        return $this->belongsTo(Boarding::class, 'boarding_id', 'boarding_id');
    }

    public function customer()
    {
        return $this->hasOneThrough(User::class, Dog::class, 'dog_id', 'customer_id', 'dog_id', 'customer_id');
    }
}
