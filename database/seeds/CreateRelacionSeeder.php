<?php

use Illuminate\Database\Seeder;
use App\Relacion;

class CreateRelacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rel = Relacion::create([
            'relacion' => 'Padre', 
            'estado' => true
        ]);

        $rel = Relacion::create([
            'relacion' => 'Madre', 
            'estado' => true
        ]);

        $rel = Relacion::create([
            'relacion' => 'Abuela(o)', 
            'estado' => true
        ]);

        $rel = Relacion::create([
            'relacion' => 'Tía(o)', 
            'estado' => true
        ]);

        $rel = Relacion::create([
            'relacion' => 'Hija(o)', 
            'estado' => true
        ]);

        $rel = Relacion::create([
            'relacion' => 'Esposa(o)', 
            'estado' => true
        ]);

        $rel = Relacion::create([
            'relacion' => 'Nieta(o)', 
            'estado' => true
        ]);

        $rel = Relacion::create([
            'relacion' => 'Sobrina(o)', 
            'estado' => true
        ]);

        $rel = Relacion::create([
            'relacion' => 'Prima(o)', 
            'estado' => true
        ]);

    }
}
