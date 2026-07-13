<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class VehicleInsPast extends Model
{
    use BelongsToTenant;

    protected $table = 'vehicle_ins_past';

    protected $fillable = [
        'vid',
        'inscom',
        'valuation',
        'insamount',
        'policy',
        'image',
        'datefrom',
        'dateto',
    ];

    protected function casts(): array
    {
        return [
            'vid' => 'integer',
            'datefrom' => 'date',
            'dateto' => 'date',
        ];
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vid');
    }
}
