<?php

namespace Database\Factories;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Conductor>
 */
class ConductorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $cliente = Cliente::factory()->times(1)->create();
        return [
            'cliente_id' => $cliente[0]->id,
            'ci' => $this->faker->numberBetween(10000,90000),
            'foto' => $this->faker->uuid().'.jpg',
            'ocupado' => 0,
            'CI_Anverso' => $this->faker->uuid().'.jpg',
            'CI_Reverso' => $this->faker->uuid().'.jpg',
            'fotoAntecedente' => $this->faker->uuid().'.jpg',
            'fotoLicencia' => $this->faker->uuid().'.jpg',
            'fotoTIC' => $this->faker->uuid().'.jpg',
            'created_at' => $this->faker->dateTime(),
        ];
    }
}
