<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class OwnerCurrent extends Model
{
    use BelongsToTenant;

    protected $table = 'owner_current';

    protected $fillable = [
        'vid',
        'name',
        'address',
        'mobile',
        'email',
        'identification',
        'narration',
    ];

    protected function casts(): array
    {
        return [
            'vid' => 'integer',
        ];
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vid');
    }
}
