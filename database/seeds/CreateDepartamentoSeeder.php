<?php

use Illuminate\Database\Seeder;
use App\Departamento;

class CreateDepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dep = Departamento::create(['id_pai' => '23', 'departamento' => 'Beni', 'estado' => true]);
        $dep = Departamento::create(['id_pai' => '23', 'departamento' => 'Chuquisaca', 'estado' => true]);
        $dep = Departamento::create(['id_pai' => '23', 'departamento' => 'Cochabamba', 'estado' => true]);
        $dep = Departamento::create(['id_pai' => '23', 'departamento' => 'La Paz', 'estado' => true]);
        $dep = Departamento::create(['id_pai' => '23', 'departamento' => 'Oruro', 'estado' => true]);
        $dep = Departamento::create(['id_pai' => '23', 'departamento' => 'Pando', 'estado' => true]);
        $dep = Departamento::create(['id_pai' => '23', 'departamento' => 'Potosí', 'estado' => true]);
        $dep = Departamento::create(['id_pai' => '23', 'departamento' => 'Santa Cruz', 'estado' => true]);
        $dep = Departamento::create(['id_pai' => '23', 'departamento' => 'Tarija', 'estado' => true]);

    }
}
