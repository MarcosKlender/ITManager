<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'serial_number',
        'cne_code',
        'brand',
        'model',
        'bios_password',
        'cpu',
        'ram',
        'storage',
        'serial_storage',
        'os',
        'status',
        'location',
        'mac_address',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
