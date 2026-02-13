<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    /**
     * កំណត់ Column ដែលអនុញ្ញាតឱ្យបញ្ចូលទិន្នន័យបាន
     */
    protected $fillable = [
        'employee_id',
        'date',
        'check_in',
        'check_out',
        'status',
    ];

    /**
     * ទំនាក់ទំនងជាមួយបុគ្គលិក (Attendance belongs to an Employee)
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}