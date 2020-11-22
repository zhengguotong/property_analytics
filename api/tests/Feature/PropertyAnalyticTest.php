<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class PropertyAnalyticTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testLocationSearch()
    {
        $this->seed();
        //test  failed case
        $response = $this->get('api/properties/analytics/search?dfd=Australia');

        $response
            ->assertStatus(404)
            ->assertJson([
                "status" => "Not Found",
            ]);
    
        $response = $this->get('api/properties/analytics/search?country=Australia');
        $response
            ->assertStatus(200)
            ->assertJson([
                'data' => []
            ]);
    }
}
