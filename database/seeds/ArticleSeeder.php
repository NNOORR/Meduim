<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Article::truncate();

        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 10; $i++) {
            \App\Models\Article::create([
                'title' => Str::random(5),
                'brief' => Str::random(3) . ' ' . Str::random(4) . ' ' . Str::random(5) . ' ' . Str::random(3),
                'description' => Str::random(3) . ' ' . Str::random(4) . ' ' . Str::random(5) . ' ' . Str::random(3) . ' ' . Str::random(3) . ' ' . Str::random(4) . ' ' . Str::random(5) . ' ' . Str::random(3) . ' ' . Str::random(3) . ' ' . Str::random(4) . ' ' . Str::random(5) . ' ' . Str::random(3) . ' ' . Str::random(3) . ' ' . Str::random(4) . ' ' . Str::random(5) . ' ' . Str::random(3) . ' ' . Str::random(3) . ' ' . Str::random(4) . ' ' . Str::random(5) . ' ' . Str::random(3) . ' ' . Str::random(3) . ' ' . Str::random(4) . ' ' . Str::random(5) . ' ' . Str::random(3),
                'author_id' => $faker->numberBetween(1, 10),
                'preview_count' => $faker->numberBetween(0, 100),
            ]);
        }
    }
}
