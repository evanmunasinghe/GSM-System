<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class Maintainance extends Model
{
    use BelongsToTenant;

    protected $table = 'maintainance';

    protected $fillable = [
        'service',
        'details',
    ];

    public function dueItems()
    {
        return $this->hasMany(VehicleMaintainanceDue::class, 'mid');
    }

    public function pastItems()
    {
        return $this->hasMany(VehicleMaintainancePast::class, 'mid');
    }
}
