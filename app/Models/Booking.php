<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $table = 'bookings';
    protected $primaryKey = 'booking_id';
    protected $fillable = [
        'dog_id',
        'boarding_id',
        'booking_date',
        'total_price'
    ];
    protected $dates = [
        'booking_date'
    ];
    public function dogs()
    {
        return $this->belongsTo(Dog::class, 'dog_id', 'dog_id');
    }
    public function boardings()
    {
        return $this->belongsTo(Boarding::class, 'boarding_id', 'boarding_id');
    }
    public function customers()
    {
        return $this->hasOneThrough(User::class, Dog::class, 'dog_id', 'customer_id');
    }
}
