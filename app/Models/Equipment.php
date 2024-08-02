<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
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
        'purchase_date',
        'price',
        'provider',
        'assignment_date',
        'return_date',
        'details',

        'os',
        'bios_password',
        'mac_address',
        'cpu',
        'ram',
        'gpu',
        'storage',
        'serial_storage',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public static function boot()
    {
        parent::boot();

        static::saving(function($model) {
            $fieldsToNullify = ['cne_code', 'mac_address', 'serial_storage'];

            foreach ($fieldsToNullify as $field) {
                if ($model->$field === '') {
                    $model->$field = null;
                }
            }
        });
    }
}
