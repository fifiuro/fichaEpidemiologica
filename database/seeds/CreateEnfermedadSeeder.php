<?php

use Illuminate\Database\Seeder;
use App\Enfermedad;

class CreateEnfermedadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $enfermedad = Enfermedad::create([
            'enfermedad' => 'Hipertension Arterial', 
            'estado' => true
        ]);

        $enfermedad = Enfermedad::create([
            'enfermedad' => 'Obesidad', 
            'estado' => true
        ]);

        $enfermedad = Enfermedad::create([
            'enfermedad' => 'Diabetes', 
            'estado' => true
        ]);

        $enfermedad = Enfermedad::create([
            'enfermedad' => 'Embarazo', 
            'estado' => true
        ]);

        $enfermedad = Enfermedad::create([
            'enfermedad' => 'Enfermedades cardiacas', 
            'estado' => true
        ]);

        $enfermedad = Enfermedad::create([
            'enfermedad' => 'Enfermedad respiratoria', 
            'estado' => true
        ]);

        $enfermedad = Enfermedad::create([
            'enfermedad' => 'Enfermedades Renal Crónica', 
            'estado' => true
        ]);
    }
}
