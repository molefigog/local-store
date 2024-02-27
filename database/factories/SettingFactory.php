<?php

namespace Database\Factories;

use App\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class SettingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Setting::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'site' => $this->faker->text(255),
            'description' => $this->faker->sentence(15),
            'tagline' => $this->faker->text(255),
            'logo' => $this->faker->text(255),
            'favicon' => $this->faker->text(255),
        ];
    }
}
