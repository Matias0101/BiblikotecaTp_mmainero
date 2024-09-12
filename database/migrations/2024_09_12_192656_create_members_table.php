<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Schemas\Grammars\CustomMysqlGrammar;
use App\Schemas\Grammars\CustomSqlServerGrammar;
use Illuminate\Support\Facades\DB;
use App\Schemas\Blueprints\CustomBlueprint;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
            // Detectamos el tipo de driver (sqlsrv o mysql)
            $driver = DB::connection()->getDriverName();
            if ($driver === 'sqlsrv') {
                // Asignar la gramática personalizada para SQL Server
                DB::connection()->setSchemaGrammar(new
                    CustomSqlServerGrammar());
            } else {
                // Asignar la gramática personalizada para MySQL
                DB::connection()->setSchemaGrammar(new
                    CustomMySqlGrammar());
            }
            // Usar la gramática personalizada para varchar
            $schema = DB::connection()->getSchemaBuilder();
            $schema->blueprintResolver(function ($table, $callback) {
                return new CustomBlueprint($table, $callback);
            });

        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('last_name', 60);
            $table->string('first_name', 60);
            $table->string('departament', 100);
            $table->string('email', 100)->nullable();
            $table->string('alternate_email', 100)->nullable();
            $table->integer('cellphone')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
