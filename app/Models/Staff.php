<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'staff';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'position',
        'department',
        'status',
        'role',
    ];

    /**
     * Relationship: Link Staff record to a User authentication account (optional).
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }
}