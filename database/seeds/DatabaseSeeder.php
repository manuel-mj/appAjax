<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $collection = collect([1, 2, 3, 4, 5, 6, 7, 8, 9]);
        $collection->random();
        
        DB::table('coches')->insert([
            'marca' => Str::random(10),
            'modelo' => Str::random(40),
            'motor' => $collection,
            'potencia' => Str::random(40),
        ]);
    }
}
