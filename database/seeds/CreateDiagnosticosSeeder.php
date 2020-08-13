<?php

use Illuminate\Database\Seeder;
use App\Diagnostico;

class CreateDiagnosticosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $diagnostico = Diagnostico::create([
            'diagnostico' => 'IRA', 
            'estado' => true
        ]);

        $diagnostico = Diagnostico::create([
            'diagnostico' => 'IRAG', 
            'estado' => true
        ]);

        $diagnostico = Diagnostico::create([
            'diagnostico' => 'Neumonía', 
            'estado' => true
        ]);
    }
}
