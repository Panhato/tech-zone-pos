<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    // បន្ថែមបន្ទាត់ខាងក្រោមនេះ ដើម្បីអនុញ្ញាតឱ្យបញ្ចូលទិន្នន័យ
    // app/Models/Employee.php
protected $fillable = [
    'name',
    'position',
    'phone',
    'user_id', // កុំភ្លេចដាក់អាមួយនេះ
];

    /**
     * ទំនាក់ទំនងជាមួយការកត់ត្រាវត្តមាន (One-to-Many)
     */
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}