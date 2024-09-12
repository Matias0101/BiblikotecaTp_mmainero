<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\LoanConfiguration;

class LoanConfigurationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LoanConfiguration::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'initial_duration' => $this->faker->numberBetween(-10000, 10000),
            'max_books' => $this->faker->numberBetween(-10000, 10000),
            'renewal_duration' => $this->faker->numberBetween(-10000, 10000),
        ];
    }
}
