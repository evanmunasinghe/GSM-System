<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user' => fake()->unique()->userName(),
            'eid' => fake()->optional()->numberBetween(1, 10000),
            'pw' => static::$password ??= Hash::make('password'),
            'email' => fake()->unique()->safeEmail(),
            'type' => 'user',
        ];
    }
}
