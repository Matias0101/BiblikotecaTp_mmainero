<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Schemas\Grammars\CustomMysqlGrammar;
use App\Schemas\Grammars\CustomSqlServerGrammar;
use Illuminate\Support\Facades\DB;
use App\Schemas\Blueprints\CustomBlueprint;

return new class extends Migration {
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

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            //$table->bigIncrements('id');
            $table->string('name');

            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            // Nombres y campos relacionados
            // $table->string('first_name', 60)->nullable();
            // $table->string('last_name', 60)->nullable();

            // Campos opcionales
            $table->string('departament', 100)->nullable();// Repartición
            $table->string('internal', 20)->nullable(); // Interno tel
            
            $table->string('cellphone')->nullable();
            $table->text('note')->nullable();

            $table->string('alternate_email', 100)->nullable();

            // Nuevo campo: Role (admin o solo lectura)
           //$table->enum('role', ['admin', 'read_only'])->default('read_only');

                 // Tokens y timestamps

            $table->rememberToken();
            $table->timestamps();// created_at, updated_at
        });
             // Crear tabla password_reset_tokens/tabla para reseteo de contraseñas
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

            // Crear tabla sessions
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
        
        Schema::dropIfExists('password_reset_tokens');
        
        Schema::dropIfExists('users');
    }
};
