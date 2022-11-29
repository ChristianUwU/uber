<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Cliente;
use App\Models\Conductor;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(SolicitudeSeeder::class);
        $this->call(ConductorSeeder::class);
        $this->call(ClienteSeeder::class);

        Cliente::factory()->times(100)->create();
        Conductor::factory()->times(100)->create();
    }
}
