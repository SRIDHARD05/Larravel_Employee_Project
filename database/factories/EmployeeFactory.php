<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Employee;
use Illuminate\Support\Str;

class EmployeeFactory extends Factory
{

    protected $model = Employee::class;

    public function definition()
    {
        return [
            'employer_id' => Str::uuid(),
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->unique()->userName() . '.' . $this->faker->domainName(),
            'position' => $this->faker->jobTitle(),
            'salary' => $this->faker->randomFloat(2, 30000, 100000),
        ];
    }
}
