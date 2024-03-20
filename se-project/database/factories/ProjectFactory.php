<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'project_id'=>fake()->name(),
            'start_date'=>fake()->date(),
            'area_date'=>fake()->date(),
            'map'=>fake()->shuffle('[A-Z]0-9'),
            'customers_contact_name'=>fake()->name(),
            'customers_contact_phone'=>fake()->randomNumber($nbDigits = NULL, $strict = false),
            'status_id'=>rand(1,3),
            'customer_id'=>rand(1,3),
            'assistant_id'=>rand(1,2)
        ];
    }
}
