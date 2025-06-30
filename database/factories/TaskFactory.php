<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::inRandomOrder()->first()->id,
            'file_id' => null,
            'title' => $this->faker->unique()->sentence(3),
            'content' => $this->faker->paragraph(),
            'status' => $this->faker->randomElement(['todo', 'in-progress', 'done']),
            'is_published' => $this->faker->boolean(),
        ];
    }
}
