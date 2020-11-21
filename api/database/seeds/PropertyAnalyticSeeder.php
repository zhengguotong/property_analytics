<?php

namespace Database\Seeders;

use JeroenZwart\CsvSeeder\CsvSeeder;

class PropertyAnalyticSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->file  = database_path('seeds/csv/property_analytics.csv');
        $this->tablename = 'property_analytics';
        $this->timestamps = date('Y-m-d H:i:s');
        $this->delimiter = ',';
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        parent::run();
    }
}
