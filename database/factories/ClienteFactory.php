<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cliente>
 */
class ClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $user = User::factory()->times(1)->create();
        return [
            'user_id' => $user[0]->id,
            'fecha_nacimiento' => date("Y-m-d"),
            'created_at' => $user[0]->created_at,
            'updated_at' => $user[0]->updated_at,
        ];
    }
}
