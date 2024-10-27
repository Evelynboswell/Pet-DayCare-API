<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Daycare extends Model
{
    use HasFactory;

    protected $table = 'daycare';
    protected $primaryKey = 'boarding_id';
    protected $keyType = 'string';
    public $incrementing = false;
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($boarding) {
            $latestBoarding = static::latest('boarding_id')->first();

            if (!$latestBoarding) {
                $nextIdNumber = 1;
            } else {
                $lastId = (int) str_replace('BRD', '', $latestBoarding->boarding_id);
                $nextIdNumber = $lastId + 1;
            }

            $boarding->boarding_id = 'BRD' . $nextIdNumber;
        });
    }
    protected $fillable = [
        'boarding_name',
        'boarding_type',
        'boarding_description',
        'price',
        'current_stock'
    ];
}
