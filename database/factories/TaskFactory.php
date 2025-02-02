<?php

namespace Database\Factories;

use App\Enums\TaskStatus;
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
            'status' => $this->faker->randomElement(['in_progress', 'done', 'todo']),
            'due_date' => $this->faker->dateTimeBetween('now', '+1 month'),
            'created_by' => 1,
            'updated_by' => 1,
        ];
    }

    public function todo(): TaskFactory
    {
        return $this->state(fn() => ['status' => TaskStatus::Todo]);
    }

    public function inProgress(): TaskFactory
    {
        return $this->state(fn() => ['status' => TaskStatus::InProgress]);
    }

    public function done(): TaskFactory
    {
        return $this->state(fn() => ['status' =>TaskStatus::Done]);
    }
}
