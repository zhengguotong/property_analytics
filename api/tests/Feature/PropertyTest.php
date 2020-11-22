<?php

namespace Tests\Feature;

use App\PropertyAnalytic;
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

        $response
            ->assertStatus(200)
            ->assertJson([
                'message' => 'New property created'
            ]);
    }

    public function testUpdateAnalytics()
    {
        $this->seed();
        //test  failed case
        $data = array(
            'value' => 'sdsd',
            'analytic_type_id' => 112
        );
          
        $response = $this->json('POST', '/api/properties/2/analytics', $data);


        $response
            ->assertStatus(401)
            ->assertJson([
                "status" => "failed",
            ]);

        //test update
        $data = array(
           'value' => '1.2',
           'analytic_type_id' => 2
       );

        $response = $this->json('POST', '/api/properties/2/analytics', $data);

        $response->assertStatus(200);
        
        //check if the value is updated
        $model = PropertyAnalytic::where('property_id', 2)
                ->where('analytic_type_id', 2)
                ->first();
        $this->assertEquals('1.2', $model->value);
    }

    public function testAnalytics()
    {
        $this->seed();
        //test  failed case
        $response = $this->get('/api/properties/83928392/analytics');

        $response
            ->assertStatus(404)
            ->assertJson([
                "status" => "Not Found",
            ]);
    
        $response = $this->get('/api/properties/2/analytics');
        $response
            ->assertStatus(200)
            ->assertJson([
                'data' => []
            ]);
    }
}
