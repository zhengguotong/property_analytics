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
       $this->setFKCheckOff();
        
        $this->call(PropertySeeder::class);
        $this->call(AnalyticTypeSeeder::class);
        $this->call(PropertyAnalyticSeeder::class);

        //restore foreign key check
        $this->setFKCheckOn();
    }

    private function setFKCheckOff() 
    {
        switch(DB::getDriverName()) {
            case 'mysql':
                DB::statement('SET FOREIGN_KEY_CHECKS=0');
                break;
            case 'sqlite':
                DB::statement('PRAGMA foreign_keys = OFF');
                break;
        }
    }

    private function setFKCheckOn() 
    {
        switch(DB::getDriverName()) {
            case 'mysql':
                DB::statement('SET FOREIGN_KEY_CHECKS=1');
                break;
            case 'sqlite':
                DB::statement('PRAGMA foreign_keys = ON');
                break;
        }
    }
}
