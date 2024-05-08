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
            ['id' => 1, 'nombre' => 'Neutro'],
            ['id' => 2, 'nombre' => 'Sospechoso'],
            ['id' => 3, 'nombre' => 'Riesgoso'],
            ['id' => 4, 'nombre' => 'Prohibido'],
        ]);
    }
}
