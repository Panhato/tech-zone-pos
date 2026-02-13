<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
protected $fillable = [
    'company_name',
    'contact_name', // <--- ត្រូវតែមានឈ្មោះនេះ
    'phone',
    'address',
    // ...
];
}