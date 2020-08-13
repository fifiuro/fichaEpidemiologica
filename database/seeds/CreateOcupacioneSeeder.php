<?php

use Illuminate\Database\Seeder;
use App\Ocupacion;

class CreateOcupacioneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ocu = Ocupacion::create([
            'ocupacion' => 'Auxiliar de Oficina', 'estado' => true
        ]);

        $ocu = Ocupacion::create([
            'ocupacion' => 'Personal de Salud', 'estado' => true
        ]);

        $ocu = Ocupacion::create([
            'ocupacion' => 'Personal de Laboratorio', 'estado' => true
        ]);
    }
}
