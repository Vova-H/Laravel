<?php

namespace Database\Factories;

use App\Models\Organization;
use App\Models\User;
use App\Models\UserVacancy;
use App\Models\Vacancy;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserVacancyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserVacancy::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user_id = User::all()->pluck('id')->toArray();
        $vacancy_id = Vacancy::all()->pluck('id')->toArray();
        return [
            'created_at'=>now(),
            'updated_at'=>now(),
            'user_id' => $this->faker->randomElement($user_id),
            'vacancy_id' => $this->faker->randomElement($vacancy_id),
        ];
    }
}
