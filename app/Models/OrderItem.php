<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
   protected $fillable = ['order_id', 'product_id', 'product_name', 'quantity', 'price'];
   // នៅក្នុង app/Models/OrderItem.php

public function product()
{
    // ត្រូវប្រាកដថា product_id ក្នុងតារាង order_items ផ្គូផ្គងជាមួយ id ក្នុងតារាង products
    return $this->belongsTo(Product::class); 
}
}

