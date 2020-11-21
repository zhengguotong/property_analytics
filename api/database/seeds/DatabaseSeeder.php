<?php

use Database\Seeders\AnalyticTypeSeeder;
use Database\Seeders\PropertyAnalyticSeeder;
use Database\Seeders\PropertySeeder;
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
        Eloquent::unguard();

        //disable foreign key check for this connection before running seeders
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        $this->call(PropertySeeder::class);
        $this->call(AnalyticTypeSeeder::class);
        $this->call(PropertyAnalyticSeeder::class);

        //restore foreign key check
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
