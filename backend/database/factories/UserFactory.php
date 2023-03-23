<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
                'name' => $this->faker->name(),
            'username' => $this->faker->unique()->userName(),
               'phone' => $this->faker->unique()->phoneNumber(),
               'email' => $this->faker->unique()->email(),
            'password' => password_hash('12345678', PASSWORD_BCRYPT ),
               'state' => 0
        ];
    }
}
