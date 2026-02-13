<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany; // បន្ថែមថ្មី

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * បង្កើតទំនាក់ទំនង One-to-Many ទៅកាន់តារាង Orders
     * ជួយឱ្យ Controller អាចប្រើ withCount('orders') បាន
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * បន្ថែម Function ដើម្បីឆែកមើលថាជា Admin ឬទេ
     */
    public function isAdmin(): bool
    {
        return in_array($this->role, ['admin', 'super_admin']);
    }
}