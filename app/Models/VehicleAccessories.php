<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class VehicleAccessories extends Model
{
    use BelongsToTenant;

    protected $table = 'vehicle_accessories';

    protected $fillable = [
        'vid',
        'part',
        'date',
        'value',
    ];

    protected function casts(): array
    {
        return [
            'vid' => 'integer',
            'date' => 'date',
        ];
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vid');
    }
}
