<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition()
    {
        $defaultCategories = [
            'Groceries', 'Transport', 'Utilities', 'Salary', 'Rent', 'Entertainment', 'Education'
        ];

        return [
            'user_id' => User::factory(),
            'name' => $this->faker->randomElement($defaultCategories),
        ];
    }
}
