<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Schemas\Blueprints\CustomBlueprint;

use App\Schemas\Grammars\CustomMysqlGrammar;
use App\Schemas\Grammars\CustomSqlServerGrammar;
use Illuminate\Support\Facades\DB;

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


        Schema::create('authors', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->date('birthdate')->nullable();
            //  clave foránea con relación explícita a la tabla countries
            $table->foreignId('country_id')->constrained('countries');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('authors');
    }
};
