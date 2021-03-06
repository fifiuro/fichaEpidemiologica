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
        $this->truncateTables([
            'relacion',
            'paises',
            'departamentos_estados',
            'ocupaciones',
            'sintomas',
            'estados_pacientes',
            'diagnosticos',
            'enfermedades',
            'muestras',
            'users',
            'personal_notificado',
            'laboratorios'
        ]);
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
        $this->call(CreateUsuarioSeeder::class);
        $this->call(CreatePersonalNotificaSeeder::class);
        $this->call(CreateLaboratorioSeeder::class);
    }

    public function truncateTables(array $tables)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');

        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
