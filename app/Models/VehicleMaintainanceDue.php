<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class VehicleMaintainanceDue extends Model
{
    use BelongsToTenant;

    protected $table = 'vehicle_maintainance_due';

    protected $fillable = [
        'mid',
        'vid',
        'mileage',
    ];

    protected function casts(): array
    {
        return [
            'mid' => 'integer',
            'vid' => 'integer',
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
