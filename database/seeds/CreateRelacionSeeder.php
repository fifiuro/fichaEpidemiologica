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
            'relacion' => 'Hermana(o)', 
            'estado' => true
        ]);
    }
}
