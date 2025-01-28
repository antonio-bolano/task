<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->text(),
            'description' => $this->faker->text(),
            'created_by' => 1,
            'updated_by' => 1,
        ];
    }

    public function open(): TaskFactory
    {
        return $this->state(fn() => ['status' => 'Open']);
    }
}
