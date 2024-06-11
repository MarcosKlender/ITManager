<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'type',
        'serial_number',
        'brand',
        'model',
        'status',
        
        'cne_code',
        'location',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
