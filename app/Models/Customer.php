<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    // Add ALL these fields to the fillable array
    protected $fillable = [
        'name',
        'email',
        'phone',
        'gender', // Added field
        'job',    // Added field
        'id_number',
        'dob',
        'pob',
        'house_no',
        'street',
        'district',
        'id_photo',
        'family_photo',
        'occupation',
        'monthly_income',
    ];

    public function deposits()
    {
        return $this->hasMany(Deposit::class);
    }
}