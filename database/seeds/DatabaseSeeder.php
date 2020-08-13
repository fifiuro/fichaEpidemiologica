<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $this->call(CreateRelacionSeeder::class);
        $this->call(CreatePaisesSeeder::class);
        $this->call(CreateDepartamentoSeeder::class);
        $this->call(CreateOcupacioneSeeder::class);
        $this->call(CreateSintomasSeeder::class);
        $this->call(CreateEstadoPacienteSeeder::class);
        $this->call(CreateDiagnosticosSeeder::class);
        $this->call(CreateEnfermedadSeeder::class);
        $this->call(CreateMuestraSeeder::class);
    }
}
