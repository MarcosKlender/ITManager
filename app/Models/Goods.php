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

    public static function boot()
    {
        parent::boot();

        static::saving(function($model) {
            $fieldsToNullify = ['cne_code'];

            foreach ($fieldsToNullify as $field) {
                if ($model->$field === '') {
                    $model->$field = null;
                }
            }
        });
    }
}
