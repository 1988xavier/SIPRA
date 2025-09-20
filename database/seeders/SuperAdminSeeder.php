<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'sandy.manzo@upb.edu.mx'],
            [
                'name' => 'Lic. Sandy Jazmin Manzo Haro',
                'password' => bcrypt('qwerty'),
                'role' => 'admin',   // o 'superadmin' si así lo manejas
                'status' => 'activo',
            ]
        );
    }
}
