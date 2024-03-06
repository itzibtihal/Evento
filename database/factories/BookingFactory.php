<?php


namespace Database\Factories;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Booking::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'event_id' =>3,
            'user_id' => 2,
            'ticket_number' => $this->faker->unique()->randomNumber(5),
            'status' => $this->faker->randomElement(['confirmed', 'waiting', 'rejected']),
            'reason_of_reject' => $this->faker->optional()->sentence,
        ];
    }
}
