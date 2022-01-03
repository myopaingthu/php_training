<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $names = ['Software Engineering', 'Knowledge Engineering', 'High Performance Computing'];
        foreach ($names as $name) {
            DB::table('majors')->insert([
                'name' => $name
            ]);
        }
    }
}
