<?php

namespace Database\Factories;

use App\Models\Owner;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class OwnerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Owner::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'email' => $this->faker->email(),
            'whatsapp' => $this->faker->text(255),
            'facebook' => $this->faker->text(255),
            'address' => $this->faker->address(),
        ];
    }
}
