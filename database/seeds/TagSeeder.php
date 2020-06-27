<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Tag::truncate();

        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 10; $i++) {
            \App\Models\Tag::create([
                'article_id' => $faker->numberBetween(1, 10),
                'name' => Str::random(4)
            ]);
        }
    }
}
