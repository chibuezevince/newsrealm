<?php

namespace Database\Seeders;

use App\Models\Manager;
use Illuminate\Database\Seeder;

class ManagerSeeder extends Seeder
{
    public function run(): void
    {
        Manager::create([
            'name' => 'Admin',
            'email' => 'admin@newsreality.live',
            'password' => 'password',
        ]);
    }
}
