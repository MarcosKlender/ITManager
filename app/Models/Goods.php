<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'serial_number',
        'cne_code',
        'brand',
        'model',
        'location',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
