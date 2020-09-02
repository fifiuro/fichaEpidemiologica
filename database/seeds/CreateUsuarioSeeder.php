<?php

use Illuminate\Database\Seeder;
use App\User;

class CreateUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'nombre_usuario' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456789')
        ]);

        User::create([
            'nombre_usuario' => 'TMOLLO',
            'email' => 'mollo@gmail.com',
            'password' => Hash::make('123456789')
        ]);
    }
}
