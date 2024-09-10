<?php

namespace App\Providers;

use App\Schemas\Grammars\CustomSqlServerGrammar;
use Closure;
use DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Schemas\Blueprints\CustomBlueprint;
use Illuminate\Database\Schema\Builder;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
          // Definir una personalización del blueprintResolver
        //   Builder::blueprintResolver(function ($table, Closure $callback = null, $prefix = '') {
        //     return new CustomBlueprint($table, $callback, $prefix);
        // });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Schema::blueprintResolver(function ($table, $callback) {
        //     return new CustomBlueprint($table, $callback);
        // });
        
        // if (DB::connection()->getDriverName() === 'sqlsrv') {
        //     DB::connection()->setSchemaGrammar(new CustomSqlServerGrammar());
        // }
        //});
    }
}

 // Usamos el Blueprint personalizado con Schema para aplicar varchar globalmente
        //  Schema::blueprintResolver(function ($table, $callback) {
        //     return new CustomBlueprint($table, $callback);