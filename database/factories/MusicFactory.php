<?php

namespace Database\Factories;

use App\Models\Music;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class MusicFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Music::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'genre_id' => $this->faker->randomDigit,
            'artist' => $this->faker->text(255),
            'title' => $this->faker->sentence(10),
            'amount' => $this->faker->text(255),
            'demo' => $this->faker->text(255),
            'description' => $this->faker->sentence(15),
            // Add other fields as needed
        ];
    }
}
