<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Empleado>
 */
class EmpleadoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // colocamos datos falsos
            'nombre' => $this->faker->name,
            'correo' => $this->faker->email,
            'telefono' => $this->faker->e164PhoneNumber,
            'department_id' => $this->faker->numberBetween(1,6)
        ];
    }
}
