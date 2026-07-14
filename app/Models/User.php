<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class User extends Authenticatable
{
    public const TYPE_SUPER_ADMIN = 'super_admin';

    public const TYPE_BRANCH_ADMIN = 'branch_admin';

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

    public function isSuperAdmin(): bool
    {
        return $this->type === self::TYPE_SUPER_ADMIN;
    }

    public function isBranchAdmin(): bool
    {
        return $this->type === self::TYPE_BRANCH_ADMIN;
    }
}
