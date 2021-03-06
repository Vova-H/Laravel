<?php

namespace Database\Factories;

use App\Models\Organization;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrganizationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Organization::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $users = User::all()->pluck('id')->toArray();

        return [
            'name' => $this->faker->company(),
            'country'=>$this->faker->country(),
            'city'=>$this->faker->city(),
            'user_id'=>$this->faker->randomElement($users),
            'created_at'=>now(),
            'updated_at'=>now(),
        ];
    }
}
