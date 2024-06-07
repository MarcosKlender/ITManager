<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'identification_number',
        'email',
        'department',
        'phone',
    ];

    public function equipment()
    {
        return $this->hasMany(Equipment::class);
    }

    public function goods()
    {
        return $this->hasMany(Goods::class);
    }
}
