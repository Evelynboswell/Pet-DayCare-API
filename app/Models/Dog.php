<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dog extends Model
{
    use HasFactory;
    protected $table = 'dogs';
    protected $primaryKey = 'dog_id';
    protected $fillable = [
        'customer_id',
        'name',
        'age',
        'weight',
        'breed',
        'color',
        'gender',
        'medical_condition'
    ];
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id', 'customer_id');
    }
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'dog_id');
    }
}
