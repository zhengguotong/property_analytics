<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class PropertyTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Test create property
     *
     * @return void
     */
    public function testStore()
    {
        //test  failed case
        $response = $this->post('/api/properties');

        $response
            ->assertStatus(401)
            ->assertJson([
                "status" => "failed",
            ]);
        
        //test success case
        $data = array(
            'suburb' => 'Gladesville',
            'state' => 'NSW',
            'country' => 'Australia'
        );
        $response = $this->json('POST', '/api/properties', $data);
        // dd($response);
        $response
            ->assertStatus(200)
            ->assertJson([
                'message' => 'New model created'
            ]);
    }
}
