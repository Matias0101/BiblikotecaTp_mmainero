<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use App\Schemas\Blueprints\CustomBlueprint;
use App\Schemas\Grammars\CustomMysqlGrammar;
use App\Schemas\Grammars\CustomSqlServerGrammar;

class CustomSchemaServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    //     // Detectar el driver de la base de datos
    //     $driver = DB::connection()->getDriverName();

    //     if ($driver === 'sqlsrv') {
    //         // Asignar la gramática personalizada para SQL Server
    //         DB::connection()->setSchemaGrammar(new CustomSqlServerGrammar());
    //     } else {
    //         // Asignar la gramática personalizada para MySQL
    //         DB::connection()->setSchemaGrammar(new CustomMySqlGrammar());
    //     }

    //     // Usar la gramática personalizada para las migraciones
    //     $schema = DB::connection()->getSchemaBuilder();
    //     $schema->blueprintResolver(function ($table, $callback) {
    //         return new CustomBlueprint($table, $callback);
    //     });
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Registrar otros servicios si es necesario
    }
}
