<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Event::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'date' => $this->faker->date,
            'hour' => $this->faker->time,
            'lieu' => $this->faker->address,
            'total_tickets' => $this->faker->numberBetween(50, 200),
            'available_tickets' => $this->faker->numberBetween(0, 50),
            'category_id' => 1, 
            'created_by' => 1, 
            'duration_of_event' => $this->faker->numberBetween(1, 24),
            'type' => $this->faker->randomElement(['online', 'presentiel']),
            'verified' => $this->faker->randomElement(['yes', 'no']),
            'status_event' => $this->faker->randomElement(['auto-accepted', 'needs-acceptation']),
            'ticket_price' => $this->faker->randomFloat(2, 10, 100),
        ];
    }
}
