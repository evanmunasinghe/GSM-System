<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class VehicleDoc extends Model
{
    use BelongsToTenant;

    protected $table = 'vehicle_doc';

    protected $fillable = [
        'vid',
        'doc',
        'file',
        'date',
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
