<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class Vehicle extends Model
{
    use BelongsToTenant;

    protected $fillable = [
        'plate',
        'engine_no',
        'chassis_no',
        'owner_id',
        'ant',
        'vehicletype',
        'make',
        'model',
        'man_year',
        'reg_year',
        'colour',
        'country',
        'bookcopy',
        'odo',
        'next_rev',
        'next_ins',
        'ins_com',
        'next_emmission',
        'm_value',
        'regdate',
    ];

    protected function casts(): array
    {
        return [
            'owner_id' => 'integer',
            'next_rev' => 'date',
            'next_ins' => 'date',
            'next_emmission' => 'date',
            'regdate' => 'date',
        ];
    }

    public function currentOwner()
    {
        return $this->belongsTo(OwnerCurrent::class, 'owner_id');
    }

    public function pastOwners()
    {
        return $this->hasMany(OwnerPast::class, 'vid');
    }

    public function documents()
    {
        return $this->hasMany(VehicleDoc::class, 'vid');
    }

    public function insuranceHistory()
    {
        return $this->hasMany(VehicleInsPast::class, 'vid');
    }

    public function facilities()
    {
        return $this->hasMany(VehicleFacility::class, 'vid');
    }

    public function accessories()
    {
        return $this->hasMany(VehicleAccessories::class, 'vid');
    }

    public function dueMaintenance()
    {
        return $this->hasMany(VehicleMaintainanceDue::class, 'vid');
    }

    public function maintenanceHistory()
    {
        return $this->hasMany(VehicleMaintainancePast::class, 'vid');
    }

    public function dueRepairs()
    {
        return $this->hasMany(VehicleDueRepaire::class, 'vid');
    }

    public function actualRepairs()
    {
        return $this->hasMany(VehicleRepaires::class, 'vid');
    }
}
