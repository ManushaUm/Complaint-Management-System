<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\ComplaintLog;
use App\Models\NewComplaint;

class ComplaintControllerTest extends TestCase
{
    use RefreshDatabase;

    
    public function testStoreComplaintValidationFailure()
    {
        // Missing required fields to simulate validation failure
        $data = [
            'category' => 'Electrical',
            'subcategory' => 'Short Circuit',
            'location' => '',
            'branch' => 'Chilaw Branch',
            'resperson' => 'John Doe',
            'altperson' => 'Jane Doe',
            'pred' => 'High',
            'description' => 'Faulty wiring causing outage',
        ];
    
        $response = $this->post(route('complaintstatus.store'), $data);
    
        // Assert that validation error messages are present
        $response->assertSessionHasErrors('location');
    }
    
public function testAssignComplaintFailure()
{
    // Using a non-existent complaint ID to simulate a failure
    $data = [
        'modalComplaintId' => 9999, // Non-existent ID
        'dept_id' => 'HR',
        'div_name' => 'HR Division',
        'district' => 'Chilaw',
        'branch' => 'Chilaw Branch',
        'notes' => 'Needs urgent attention',
    ];

    $response = $this->put(route('assign.complaint'), $data);

    // Assert that error message is shown for non-existent complaint
    $response->assertRedirect()->assertSessionHas('error', 'Complaint not found.');
}


public function testAddCommentValidationFailure()
{
    // Missing comment input to simulate validation failure
    $data = [
        'commentmessage-input' => '',
    ];

    $response = $this->post(route('add-comment', 1), $data);

    // Assert that validation error message is shown
    $response->assertSessionHasErrors('commentmessage-input');
}


public function testAssignJobFailure()
{
    // Non-existent complaint ID to simulate failure
    $response = $this->post(route('assign-job', 9999));

    // Assert that error message is shown for non-existent complaint
    $response->assertRedirect()->assertSessionHas('error', 'Complaint not Found. Please contact your administrator');
}

}
