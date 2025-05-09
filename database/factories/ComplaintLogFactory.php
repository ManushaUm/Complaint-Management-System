<?php


namespace Database\Factories;

use App\Models\ComplaintLog;
use Illuminate\Database\Eloquent\Factories\Factory;

class ComplaintLogFactory extends Factory
{
    protected $model = ComplaintLog::class;

    public function definition()
    {
        return [
            'Reference_number' => \App\Models\NewComplaint::factory(),
            'Status' => null,
            'assigned_to' => null,
            'Comment' => null,
            'Comment_by' => null,
            'Notes' => $this->faker->sentence,
        ];
    }
}
