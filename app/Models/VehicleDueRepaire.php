<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class VehicleDueRepaire extends Model
{
    use BelongsToTenant;

    protected $table = 'vehicle_due_repaire';

    protected $fillable = [
        'vid',
        'type',
        'details',
        'date',
        'status',
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
