<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class OwnerPast extends Model
{
    use BelongsToTenant;

    protected $table = 'owners_past';

    protected $fillable = [
        'vid',
        'owner',
        'date',
        'count',
    ];

    protected function casts(): array
    {
        return [
            'vid' => 'integer',
            'date' => 'date',
            'count' => 'integer',
        ];
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vid');
    }
}
