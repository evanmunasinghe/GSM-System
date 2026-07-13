<?php

namespace App\Models;

use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Database\Concerns\HasDomains;

class Tenant extends BaseTenant
{
    use HasDomains;

    public static function getCustomColumns(): array
    {
        return [
            'id',
            'com_name',
            'address',
            'tel',
            'email',
            'logo',
            'tag',
            'admin',
            'contact',
            'ant',
        ];
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
