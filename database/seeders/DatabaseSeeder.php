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

        $jayarathnaAuto = Tenant::updateOrCreate(
            ['id' => 'jayarathna-auto'],
            [
                'com_name' => 'Jayarathna Auto',
                'email' => config('auth.branch_admin.email'),
                'tag' => 'jayarathna-auto',
                'admin' => 'Jayarathna Auto Administrator',
                'contact' => config('auth.branch_admin.email'),
            ],
        );

        $jayarathnaAuto->domains()->updateOrCreate([
            'domain' => 'jayarathna-auto.localhost',
        ]);

        $jayarathnaAuto->users()->updateOrCreate(
            ['email' => config('auth.branch_admin.email')],
            [
                'user' => 'Jayarathna Auto Administrator',
                'eid' => 1,
                'pw' => config('auth.branch_admin.password'),
                'type' => User::TYPE_BRANCH_ADMIN,
            ],
        );
    }
}
