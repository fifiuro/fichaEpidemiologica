<?php

use Illuminate\Database\Seeder;
use App\Sintoma;

class CreateSintomasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sintoma = Sintoma::create([
            'sintoma' => 'Tos seca', 
            'estado' => true
        ]);

        $sintoma = Sintoma::create([
            'sintoma' => 'Fiebre', 
            'estado' => true
        ]);

        $sintoma = Sintoma::create([
            'sintoma' => 'Malestar General', 
            'estado' => true
        ]);

        $sintoma = Sintoma::create([
            'sintoma' => 'Cefalea', 
            'estado' => true
        ]);

        $sintoma = Sintoma::create([
            'sintoma' => 'Dificultad Respiratoria', 
            'estado' => true
        ]);

        $sintoma = Sintoma::create([
            'sintoma' => 'Mialgias', 
            'estado' => true
        ]);

        $sintoma = Sintoma::create([
            'sintoma' => 'Dolor de garganta', 
            'estado' => true
        ]);

        $sintoma = Sintoma::create([
            'sintoma' => 'Perdida y/o disminución del sentido del olfato', 
            'estado' => true
        ]);

        $sintoma = Sintoma::create([
            'sintoma' => 'Perdida y/o disminución del sentido del gusto', 
            'estado' => true
        ]);

        $sintoma = Sintoma::create([
            'sintoma' => 'Asitomático', 
            'estado' => true
        ]);

    }
}
