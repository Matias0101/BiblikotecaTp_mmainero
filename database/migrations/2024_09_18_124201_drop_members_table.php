<?php

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
        // Verificar si la columna `member_id` existe en la tabla `book_loans`
        Schema::table('book_loans', function (Blueprint $table) {
            if (Schema::hasColumn('book_loans', 'member_id')) {
                $table->dropForeign(['member_id']); // Eliminar la clave foránea si existe
                $table->dropColumn('member_id'); // Eliminar la columna si existe
            }
        });

        // Luego, eliminar la tabla `members`
        Schema::dropIfExists('members');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Si haces un rollback, recreas la tabla `members` y restableces la clave foránea
        Schema::create('members', function (Blueprint $table) {
            $table->id('id_usuario');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('apellido', 60);
            $table->string('nombre', 60);
            $table->string('reparticion', 100)->nullable();
            $table->string('interno', 20)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('celular', 20)->nullable();
            $table->text('nota')->nullable();
            $table->timestamps();
        });

        // Restaurar la relación foránea en `book_loans`
        Schema::table('book_loans', function (Blueprint $table) {
            $table->foreignId('member_id')->constrained('members')->onDelete('cascade');
        });
    }
};

