<?php

namespace Database\Seeders;

use JeroenZwart\CsvSeeder\CsvSeeder;
use Illuminate\Support\Str;

class PropertySeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->file  = database_path('seeds/csv/properties.csv');
        $this->tablename = 'properties';
        $this->timestamps = date('Y-m-d H:i:s');
        $this->delimiter = ',';
        $this->parsers = ['guid' => function () {
            return (string) Str::uuid();
        }];
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
