<?php

use Illuminate\Database\Seeder;

class NationalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Nationality::truncate();

        $nationalities = ['Syrian', 'Jordan', 'Lebanenons'];

        for ($i = 0; $i < count($nationalities); $i++) {
            \App\Models\Nationality::create([
                'name' => $nationalities[$i],
            ]);
        }
    }
}
