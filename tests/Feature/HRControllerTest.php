<?php

namespace Tests\Feature;

use App\Models\HR;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HRControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function test_index()
    {
        // Create some HR records using the factory
        HR::factory()->count(5)->create();

        // Make a GET request to the index route
        $response = $this->get(route('hr.index'));

        // Assert that the response is successful and contains HR data
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonCount(5);
    }

}
