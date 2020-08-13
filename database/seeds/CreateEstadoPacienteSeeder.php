<?php

use Illuminate\Database\Seeder;
use App\EstadoPaciente;

class CreateEstadoPacienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estado = EstadoPaciente::create([
            'nombre' => 'Leve', 
            'estado' => true
        ]);

        $estado = EstadoPaciente::create([
            'nombre' => 'Grave', 
            'estado' => true
        ]);

        $estado = EstadoPaciente::create([
            'nombre' => 'Fallecido', 
            'estado' => true
        ]);
    }
}
