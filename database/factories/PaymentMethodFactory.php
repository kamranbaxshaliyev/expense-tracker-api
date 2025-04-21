<?php

namespace Database\Factories;

use App\Models\PaymentMethod;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentMethodFactory extends Factory
{
    protected $model = PaymentMethod::class;

    public function definition()
    {
        $methods = ['Cash', 'Credit Card', 'Debit Card', 'Bank Transfer', 'PayPal'];

        return [
            'user_id' => User::factory(),
            'name' => $this->faker->randomElement($methods),
        ];
    }
}
