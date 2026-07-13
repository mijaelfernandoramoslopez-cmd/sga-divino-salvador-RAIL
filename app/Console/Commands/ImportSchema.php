<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ImportSchema extends Command
{
    protected $signature = 'db:import-schema {--force : Borra TODAS las tablas y reimporta desde cero}';
    protected $description = 'Importa el dump SQL. Con --force borra todo antes.';

    public function handle(): int
    {
        $file = database_path('sql/schema.sql');

        if (!file_exists($file)) {
            $this->warn("No se encontró {$file}. Nada que importar.");
            return self::SUCCESS;
        }

        if (!$this->option('force') && Schema::hasTable('roles')) {
            $this->info('BD ya contiene el esquema (tabla "roles" existe). Saltando.');
            return self::SUCCESS;
        }

        if ($this->option('force')) {
            $this->warn('MODO --force: eliminando todas las tablas existentes...');
            try {
                DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
                $tables = DB::select('SHOW TABLES');
                $dbName = DB::getDatabaseName();
                $key = 'Tables_in_' . $dbName;
                foreach ($tables as $row) {
                    $t = $row->$key ?? array_values((array)$row)[0];
                    DB::statement("DROP TABLE IF EXISTS `{$t}`");
                    $this->line("  drop {$t}");
                }
                DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
            } catch (\Throwable $e) {
                $this->error('Error dropeando tablas: ' . $e->getMessage());
                return self::FAILURE;
            }
        }

        $this->info("Importando {$file} ...");
        $sql = file_get_contents($file);
        if ($sql === false || trim($sql) === '') {
            $this->error('No se pudo leer el archivo SQL o está vacío.');
            return self::FAILURE;
        }

        try {
            DB::unprepared($sql);
            $this->info('Esquema y datos importados correctamente.');
            return self::SUCCESS;
        } catch (\Throwable $e) {
            $this->error('Error importando el SQL: ' . $e->getMessage());
            return self::FAILURE;
        }
    }
}
