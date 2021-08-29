<?php

namespace Database\Seeders;

use App\Models\UserVacancy;
use Illuminate\Database\Seeder;

class UserVacancySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserVacancy::factory()->count(100)->create();
    }
}
