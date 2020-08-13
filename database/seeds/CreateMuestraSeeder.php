<?php

use Illuminate\Database\Seeder;
use App\Muestra;

class CreateMuestraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $muestra = Muestra::create([
            'muestra' => 'Aspirado', 
            'estado' => true
        ]);

        $muestra = Muestra::create([
            'muestra' => 'Lavado Bronco Aleolar', 
            'estado' => true
        ]);

        $muestra = Muestra::create([
            'muestra' => 'Hisopado Nasofaríngeo', 
            'estado' => true
        ]);

        $muestra = Muestra::create([
            'muestra' => 'Hisopado Combinado', 
            'estado' => true
        ]);
    }
}
