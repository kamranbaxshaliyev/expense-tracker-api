<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\PaymentMethod;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

    public function definition()
    {
        $descs = [
            'Paid electricity bill',
            'Monthly salary',
            'Bought groceries',
            'Netflix subscription',
            'Dinner with friends',
            'Bus ticket',
            'Gym membership',
            'Received freelance payment',
        ];

        return [
            'user_id' => User::factory(),
            'type' => $this->faker->randomElement(['income', 'expense']),
            'category_id' => Category::factory(),
            'payment_method_id' => PaymentMethod::factory(),
            'amount' => $this->faker->randomFloat(2, 1, 1000),
            'description' => $this->faker->randomElement($descs),
            'date' => $this->faker->date(),
            'recurring_period' => $this->faker->randomElement(['daily', 'monthly', 'annually']),
        ];
    }
}
