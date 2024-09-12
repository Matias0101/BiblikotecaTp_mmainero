<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Book;
use App\Models\BookLoans;
use App\Models\Member;

class BookLoansFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BookLoans::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'member_id' => Member::factory(),
            'book_id' => Book::factory(),
            'loan_date' => $this->faker->date(),
            'return_date' => $this->faker->date(),
            'renewal_date' => $this->faker->date(),
        ];
    }
}
