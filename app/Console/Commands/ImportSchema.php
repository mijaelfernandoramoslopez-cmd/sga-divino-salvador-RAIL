<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ImportSchema extends Command
{
    protected $signature = 'db:import-schema {--force : Fuerza la importación aunque ya existan tablas}';
    protected $description = 'Importa el dump SQL inicial (database/sql/schema.sql) si la BD está vacía';

    public function handle(): int
    {
        $file = database_path('sql/schema.sql');

        if (!file_exists($file)) {
            $this->warn("No se encontró {$file}. Nada que importar.");
            return self::SUCCESS;
        }

        if (!$this->option('force') && Schema::hasTable('roles')) {
            $this->info('La BD ya contiene el esquema (tabla "roles" existe). Saltando importación.');
            return self::SUCCESS;
        }

        $this->info("Importando {$file} ...");
        $sql = file_get_contents($file);
        if ($sql === false || trim($sql) === '') {
            $this->error('No se pudo leer el archivo SQL o está vacío.');
            return self::FAILURE;
        }

        try {
            DB::unprepared($sql);
            $this->info('Esquema importado correctamente.');
            return self::SUCCESS;
        } catch (\Throwable $e) {
            $this->error('Error importando el SQL: ' . $e->getMessage());
            return self::FAILURE;
        }
    }
}
