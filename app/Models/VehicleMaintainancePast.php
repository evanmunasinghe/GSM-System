<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class VehicleMaintainancePast extends Model
{
    use BelongsToTenant;

    protected $table = 'vehicle_maintainance_past';

    protected $fillable = [
        'mid',
        'vid',
        'mileage',
        'date_time',
        'description',
    ];

    protected function casts(): array
    {
        return [
            'mid' => 'integer',
            'vid' => 'integer',
            'date_time' => 'datetime',
        ];
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vid');
    }

    public function masterService()
    {
        return $this->belongsTo(Maintainance::class, 'mid');
    }
}
