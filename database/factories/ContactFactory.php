<?php

namespace Database\Factories;
use App\Models\Contact;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {
        return [
            'FirstName' => $this->faker->name,
            'LastName' => $this->faker->name,
            'Email' => $this->faker->unique()->email,
            'PhoneNumber' => $this->faker->phoneNumber, // password

        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
