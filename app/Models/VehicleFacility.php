<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class VehicleFacility extends Model
{
    use BelongsToTenant;

    protected $table = 'vehicle_facility';

    protected $fillable = [
        'vid',
        'company',
        'valuation',
        'type',
        'startdate',
        'enddate',
    ];

    protected function casts(): array
    {
        return [
            'vid' => 'integer',
            'startdate' => 'date',
            'enddate' => 'date',
        ];
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vid');
    }
}
