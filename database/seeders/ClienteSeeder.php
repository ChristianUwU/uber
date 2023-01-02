<?php

namespace Database\Seeders;

use App\Models\Cliente;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cliente::create([
            'user_id' => 5,
        ]);

        Cliente::create([
            'user_id' => 6,
        ]);

        Cliente::create([
            'user_id' => 7,
        ]);

        Cliente::create([
            'user_id' => 8,
        ]);
        
        Cliente::create([
            'user_id' => 9,
        ]);
    }
}
