<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // បន្ថែម 'customer_phone' និង 'customer_address' ចូលក្នុងនេះ
    protected $fillable = [
        'user_id',
        'customer_name',
        'customer_phone',   // <--- បន្ថែមថ្មី
        'customer_address', // <--- បន្ថែមថ្មី
        'total_price',
        'status'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function user()
{
    return $this->belongsTo(User::class);
}
}