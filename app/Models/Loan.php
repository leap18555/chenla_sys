<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'customer_id',
        'loan_number',     // 👈 Added
        'purpose',         // 👈 Added
        'type',
        'amount',
        'interest_rate',
        'duration',
        'frequency',       // 👈 Added
        'start_date',      // 👈 Added
        'method',          // 👈 Added
        'currency',
        'total_interest',
        'total_payable',
        'monthly_payment',
        'status',
    ];

    /**
     * Get the user that created/manages the loan.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the customer associated with the loan.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}