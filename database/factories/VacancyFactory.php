<?php

namespace Database\Factories;

use App\Models\Vacancy;
use Illuminate\Database\Eloquent\Factories\Factory;

class VacancyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vacancy::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'amount_workers' => $this->faker->numberBetween(1, 30),
            'salary' => $this->faker->numberBetween(500, 7000) . '$',
            'created_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
