<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Loan;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public function loans()
{
    return $this->hasMany(\App\Models\Loan::class);
}
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
      protected $fillable = [
        'name', 'email', 'password', 'role', 'avatar'
    ];

     // convenience helper
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

     // optionally accessor for avatar url
    public function getAvatarUrlAttribute()
    {
        if ($this->avatar) {
            return asset('storage/' . $this->avatar);
        }
        //return asset('#'); // provide a default
    }




    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
