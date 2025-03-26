<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class ComplaintTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
        $this->artisan('migrate', ['--env' => 'testing']); // Ensure migrations run
    }

    /** @test */
    public function authenticated_user_can_lodge_complaint()
    {
        $user = User::factory()->create([
            'email' => 'user@example.com',
            'password' => bcrypt('password123'),
            'emp_id' => 'EMP002',
            'role' => 'user',
            'department' => 'IT', // Add department for viewcomplaint()
        ]);

        $this->actingAs($user);

        $response = $this->post('/complaints', [ // Adjust route if needed
            'name' => 'Test User',
            'insured' => 'Yes',
            'address' => '123 Test St',
            'contact_no' => '1234567890',
            'email' => 'test@example.com',
            'customer_type' => 'Individual',
            'policy_number' => 'POL123',
            'complaint_date' => '2025-03-25',
            'complaint_detail' => 'This is a test complaint',
        ]);

        dump($response->status());
        dump($response->session()->all()); // Check success/error message
        $response->assertRedirect(); // Expect redirect back
        $response->assertSessionHas('success', 'Complaint successfully logged');

        $this->assertDatabaseHas('new_complaints', [
            'name' => 'Test User',
            'complaint_detail' => 'This is a test complaint',
            'policy_number' => 'POL123',
        ]);
    }

    /** @test */
    public function authenticated_user_can_view_complaints()
    {
        $user = User::factory()->create([
            'email' => 'user@example.com',
            'password' => bcrypt('password123'),
            'emp_id' => 'EMP002',
            'role' => 'user',
            'department' => 'IT',
        ]);

        $this->actingAs($user);

        $response = $this->get('/viewcomplaint');
        dump($response->status());
        dump($response->content());

        $response->assertStatus(200);
    }

    /** @test */
    public function guest_cannot_lodge_complaint()
    {
        $response = $this->post('/complaints', [ // Adjust route if needed
            'name' => 'Test User',
            'insured' => 'Yes',
            'address' => '123 Test St',
            'contact_no' => '1234567890',
            'email' => 'test@example.com',
            'customer_type' => 'Individual',
            'policy_number' => 'POL123',
            'complaint_date' => '2025-03-25',
            'complaint_detail' => 'This should fail',
        ]);

        dump($response->status());
        dump($response->redirect()->getTargetUrl() ?? 'No redirect');
        $response->assertRedirect('/login');

        $this->assertDatabaseMissing('new_complaints', [
            'policy_number' => 'POL123',
        ]);
    }
}