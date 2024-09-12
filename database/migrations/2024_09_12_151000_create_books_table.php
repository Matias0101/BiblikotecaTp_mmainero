<?php

use App\Schemas\Blueprints\CustomBlueprint;
use App\Schemas\Grammars\CustomMysqlGrammar;
use App\Schemas\Grammars\CustomSqlServerGrammar;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
                 CustomMysqlGrammar());
         }
         // Usar la gramática personalizada para varchar
         $schema = DB::connection()->getSchemaBuilder();
         $schema->blueprintResolver(function ($table, $callback) {
             return new CustomBlueprint($table, $callback);
         });


        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('type', 20);
            $table->string('signature', 50);
            $table->string('signature2', 30)->nullable();
            $table->string('title');
            $table->string('pages', 10)->nullable();
            $table->string('features', 150)->nullable();
            $table->string('place_of_edition', 35)->nullable();
            $table->string('edition_info', 120)->nullable();
            $table->string('dimensions', 30)->nullable();
            $table->date('year');
            $table->string('isbn', 120)->nullable();
            $table->string('format', 60)->nullable();
            $table->string('language', 100)->nullable();
            $table->text('note')->nullable();
            $table->string('inventory')->nullable();
            $table->string('origin', 120)->nullable();
            $table->string('other_authors')->nullable();

            $table->foreignId('publisher_id')->nullable()->constrained('publishers')->onDelete('set null');
                //$table->integer('publisher_id')->nullable();
            $table->string('image')->nullable();
            $table->string('location')->nullable();
            $table->string('additional_info')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
