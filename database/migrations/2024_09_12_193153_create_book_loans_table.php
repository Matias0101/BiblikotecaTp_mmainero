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

        Schema::disableForeignKeyConstraints();

        Schema::create('book_loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relación con users
            $table->foreignId('book_id')->constrained()->onDelete('cascade'); // Relación con books
            $table->date('loan_date');
            $table->date('return_date')->nullable();;
            $table->date('renewal_date')->nullable();;
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_loans');
    }
};
