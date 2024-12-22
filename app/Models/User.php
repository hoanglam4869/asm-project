<?php

// app/Models/User.php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable; // Kết hợp HasFactory và Notifiable

    protected $fillable = ['name', 'email', 'password'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Quan hệ 1-1 với Customer
    public function customer()
    {
        return $this->hasOne(Customer::class);
    }

    // Quan hệ 1-1 với Cart
    public function cart()
    {
        return $this->hasOne(Cart::class);
    }

    
}
