<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use BelongsToTenant, HasFactory, Notifiable;

    protected $fillable = [
        'user',
        'eid',
        'pw',
        'email',
        'type',
    ];

    protected $hidden = [
        'pw',
    ];

    protected function casts(): array
    {
        return [
            'eid' => 'integer',
            'pw' => 'hashed',
        ];
    }

    public function getAuthPasswordName(): string
    {
        return 'pw';
    }
}
