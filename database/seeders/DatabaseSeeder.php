<?php

namespace Database\Seeders;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $systemTenant = Tenant::updateOrCreate(
            ['id' => 'fleev-system'],
            [
                'com_name' => 'FleeV System Administration',
                'email' => config('auth.super_admin.email'),
                'tag' => 'system',
                'admin' => 'Super Administrator',
            ],
        );

        $systemTenant->users()->updateOrCreate(
            ['email' => config('auth.super_admin.email')],
            [
                'user' => 'Super Administrator',
                'eid' => null,
                'pw' => config('auth.super_admin.password'),
                'type' => User::TYPE_SUPER_ADMIN,
            ],
        );
    }
}
