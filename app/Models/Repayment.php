<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Repayment extends Model
{
    protected $fillable = [
        'loan_id', 
        'receipt_code', 
        'payment_date', 
        'amount_paid', 
        'penalty_amount', 
        'payment_method', 
        'notes'
    ];

    protected $casts = [
        'payment_date' => 'date',
    ];

    // Connects this repayment back to its parent Loan record
    public function loan(): BelongsTo
    {
        return $this->belongsTo(Loan::class);
    }
}