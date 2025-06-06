<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attacker>
 */
class AttackerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "ipv4"        => $this->faker->ipv4(),
            "description" => $this->faker->text(),
            "country"     => $this->faker->country(),
            "created_at"  => $this->faker->dateTimeThisMonth()->format('Y-m-d H:i:s')
        ];
    }
}
