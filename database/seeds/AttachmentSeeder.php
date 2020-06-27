<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AttachmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Attachment::truncate();

        $faker = \Faker\Factory::create();

       /* for ($i = 0; $i < 10; $i++) {
            \App\Models\Attachment::create([
                'article_id' => $faker->numberBetween(1, 10),
                'path' => Str::random(4)
            ]);
        }*/
    }
}
