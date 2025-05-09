<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\NewComplaint>
 */
class NewComplaintFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'insured' => $this->faker->boolean,
            'relation' => $this->faker->word,
            'address' => $this->faker->address,
            'contact_no' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'customer_type' => $this->faker->word,
            'policy_number' => $this->faker->word,
            'complaint_date' => now(),
            'complaint_detail' => $this->faker->sentence,
            'attachment' => null,
            'complaint_status' => 0,
            'logged_by' => null, 
        ];
    }
}
