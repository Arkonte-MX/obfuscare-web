<?php

namespace Database\Seeders;

use App\Models\Alternativa;
use App\Models\Severidad;
use App\Models\Ofuscable;
use App\Models\User;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Jonathan Muñoz Lucas',
            'email' => 'admin@obfuscare.com.mx',
        ]);

        Severidad::insert([
            ['id' => 0, 'nombre' => 'Neutro'],
            ['id' => 1, 'nombre' => 'Sospechoso'],
            ['id' => 2, 'nombre' => 'Riesgoso'],
            ['id' => 3, 'nombre' => 'Prohibido'],
        ]);
    }
}
