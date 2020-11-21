<?php

namespace Database\Seeders;

use JeroenZwart\CsvSeeder\CsvSeeder;

class AnalyticTypeSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->file  = database_path('seeds/csv/analytic_types.csv');
        $this->tablename = 'analytic_types';
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
