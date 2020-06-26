<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Author::truncate();

        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 10; $i++) {
            \App\Models\Author::create([
                'name' => Str::random(5),
                'age' => $faker->numberBetween(18, 50),
                'nationality_id' => $faker->numberBetween(1, 3),
            ]);
        }
    }
}
