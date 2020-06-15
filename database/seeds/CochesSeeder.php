<?php

use Illuminate\Database\Seeder;

use App\Coche;

class CochesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Coche::class, 50)->create();
    }
}
