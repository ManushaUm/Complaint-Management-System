<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;

class AdminAuthTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_can_view_admin_login_page()
    {
        $response = $this->get('/admin/login');
        $response->assertStatus(200);
    }

    /** @test */
    public function guests_cannot_access_admin_dashboard()
    {
        $response = $this->get('/admin/dashboard');
        $response->assertRedirect('/login');
    }

    /** @test */
    public function admin_can_login()
    {
        $admin = \App\Models\User::factory()->create([
            'email' => 'admin@example.com',
            'password' => bcrypt('password123'),
            'emp_id' => 'EMP001',
            'role' => 'admin',
        ]);

        $this->actingAs($admin);
        $response = $this->get('/admin/dashboard');

        $response->assertStatus(200);
        $this->assertAuthenticatedAs($admin);
    }

    /** @test */
    public function admin_can_logout()
    {
        $admin = \App\Models\User::factory()->create([
            'email' => 'admin@example.com',
            'password' => bcrypt('password123'),
            'emp_id' => 'EMP001',
            'role' => 'admin',
        ]);

        $this->actingAs($admin);
        Auth::logout(); // Programmatically log out

        $response = $this->get('/admin/dashboard');
        $response->assertRedirect('/login'); // After logout, should redirect to login
        $this->assertGuest();
    }
}