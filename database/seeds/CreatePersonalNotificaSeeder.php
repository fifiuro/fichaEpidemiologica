<?php

use Illuminate\Database\Seeder;
use App\PersonalNotifica;

class CreatePersonalNotificaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PersonalNotifica::create([
            'nombre_notifica' => 'Adminnistrador',
            'id' => 1,
            'paterno_notifica' => 'Admin',
            'materno_notifica' => 'Admin',
            'tel_cel_notifica' => '12345678',
            'matricula_profesional' => 'A1234'
        ]);

        PersonalNotifica::create([
            'nombre_notifica' => 'TANIA',
            'id' => 2,
            'paterno_notifica' => 'MOLLO',
            'materno_notifica' => 'TAPIA',
            'tel_cel_notifica' => '7896541',
            'matricula_profesional' => 'B4567'
        ]);
    }
}
