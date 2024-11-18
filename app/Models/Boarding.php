<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boarding extends Model
{
    use HasFactory;
    protected $table = 'boardings';
    protected $primaryKey = 'boarding_id';
    protected $fillable = [
        'boarding_name',
        'boarding_type',
        'boarding_description',
        'price',
        'current_stock'
    ];
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'boarding_id', 'boarding_id');
    }
}
