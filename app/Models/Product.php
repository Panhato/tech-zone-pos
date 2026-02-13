<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // ១. Import SoftDeletes

class Product extends Model
{
    use HasFactory, SoftDeletes; // ២. ហៅប្រើ Trait នៅទីនេះ

// app/Models/Product.php
protected $fillable = [
    'name', 
    'price', 
    'qty', 
    'category_id', 
    'supplier_id', 
    'image', 
    'description', 
    'brand',
    'discount_percent',   // <--- បន្ថែមថ្មី
    'discount_end_date',  // <--- បន្ថែមថ្មី
];

// បន្ថែម Function ជំនួយដើម្បីគណនាតម្លៃដែលបញ្ចុះរួច (Optional)
public function getDiscountedPriceAttribute()
{
    if ($this->discount_percent && $this->discount_percent > 0) {
        // តម្លៃលក់ = តម្លៃដើម - (តម្លៃដើម * % / 100)
        return $this->price - ($this->price * $this->discount_percent / 100);
    }
    return $this->price;
}

    // ... code ទំនាក់ទំនងផ្សេងៗ (Relationships) នៅខាងក្រោមទុកដដែល ...
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
    public function transactions() {
    return $this->hasMany(StockTransaction::class);
}
}