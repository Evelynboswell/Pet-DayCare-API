<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dog extends Model
{
    use HasFactory;

    protected $table = 'dog';
    protected $primaryKey = 'dog_id';
    protected $keyType = 'string';
    public $incrementing = false;
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($dog) {
            $latestDog = static::latest('dog_id')->first();

            if (!$latestDog) {
                $nextIdNumber = 1;
            } else {
                $lastId = (int) str_replace('DOG', '', $latestDog->dog_id);
                $nextIdNumber = $lastId + 1;
            }

            $dog->dog_id = 'DOG' . $nextIdNumber;
        });
    }
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
}
