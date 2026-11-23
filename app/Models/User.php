<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'avatar',
        'phone',
        'bio',
    ];

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
        'password'          => 'hashed',
    ];

    /**
     * Accessors to append to the model's JSON/Array form for API responses.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'avatar_url',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function loans(): HasMany
    {
        return $this->hasMany(Loan::class);
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Helper Functions & Accessors
    |--------------------------------------------------------------------------
    */

    /**
     * ពិនិត្យមើលថាតើអ្នកប្រើប្រាស់ជា Admin ឬទេ
     * Supports both 'admin' string, 1 integer/string, and null safety in PHP 8.1+
     */
    public function isAdmin(): bool
    {
        $role = strtolower((string) $this->role);

        return $role === 'admin' || $role === '1';
    }

    /**
     * ផ្ទៀងផ្ទាត់សិទ្ធិ (Check Permission)
     */
    public function hasPermission(string $permissionSlug): bool
    {
        // ប្រសិនបើជា Admin ឱ្យមានសិទ្ធិទាំងអស់ដោយស្វ័យប្រវត្តិ
        if ($this->isAdmin()) {
            return true;
        }

        return $this->roles()->whereHas('permissions', function ($query) use ($permissionSlug) {
            $query->where('slug', $permissionSlug);
        })->exists();
    }

    /**
     * ទាញយក URL រូបភាព Avatar (ជាមួយនឹង Default UI Avatar)
     */
    public function getAvatarUrlAttribute(): string
    {
        if (!empty($this->avatar)) {
            // If avatar is already a full URL, return it directly
            if (filter_var($this->avatar, FILTER_VALIDATE_URL)) {
                return $this->avatar;
            }

            return asset('storage/' . ltrim($this->avatar, '/'));
        }

        return 'https://ui-avatars.com/api/?name=' . urlencode((string) $this->name) . '&color=7F9CF5&background=EBF4FF';
    }
}
