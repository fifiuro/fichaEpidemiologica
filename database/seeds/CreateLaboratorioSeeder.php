<?php

use Illuminate\Database\Seeder;
use App\Laboratorio;

class CreateLaboratorioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lab = Laboratorio::create([
            'id_pn' => '1', 
            'muestra' => '1',
            'lugar_muestra' => '',
            'id_mue' => '1',
            'nombre_laboratorio' => '',
            'responsable_muestra' => '',
            'observaciones' => '',
            'resultado_laboratorio' => '1',
            'numero' => '1',
            'estado' => '1'
        ]);
    }
}
