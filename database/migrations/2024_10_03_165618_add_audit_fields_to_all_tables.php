<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Schema::table('all_tables', function (Blueprint $table) {
        //
        //});
        // Modificar la tabla "users"
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'created_by')) {
                $table->unsignedBigInteger('created_by')->nullable();
                $table->foreign('created_by')->references('id')->on('users')->onDelete('NO ACTION');
            }

            if (!Schema::hasColumn('users', 'updated_by')) {
                $table->unsignedBigInteger('updated_by')->nullable();
                $table->foreign('updated_by')->references('id')->on('users')->onDelete('NO ACTION');
            }
        });

        // Modificar la tabla "authors"
        Schema::table('authors', function (Blueprint $table) {
            if (!Schema::hasColumn('authors', 'created_by')) {
                $table->unsignedBigInteger('created_by')->nullable();
                $table->foreign('created_by')->references('id')->on('users')->onDelete('NO ACTION');
            }

            if (!Schema::hasColumn('authors', 'updated_by')) {
                $table->unsignedBigInteger('updated_by')->nullable();
                $table->foreign('updated_by')->references('id')->on('users')->onDelete('NO ACTION');
            }
        });
        // Modificar la tabla "books" 
        Schema::table('books', function (Blueprint $table) {
            if (!Schema::hasColumn('books', 'created_by')) {
                $table->unsignedBigInteger('created_by')->nullable();
                $table->foreign('created_by')->references('id')->on('users')->onDelete('NO ACTION');
            }

            if (!Schema::hasColumn('books', 'updated_by')) {
                $table->unsignedBigInteger('updated_by')->nullable();
                $table->foreign('updated_by')->references('id')->on('users')->onDelete('NO ACTION');
            }
        });

        // Modificar la tabla "publishers" 
        Schema::table('publishers', function (Blueprint $table) {
            if (!Schema::hasColumn('publishers', 'created_by')) {
                $table->unsignedBigInteger('created_by')->nullable();
                $table->foreign('created_by')->references('id')->on('users')->onDelete('NO ACTION');
            }

            if (!Schema::hasColumn('publishers', 'updated_by')) {
                $table->unsignedBigInteger('updated_by')->nullable();
                $table->foreign('updated_by')->references('id')->on('users')->onDelete('NO ACTION');
            }
        });

    
        // Modificar la tabla "countries" 
        Schema::table('countries', function (Blueprint $table) {
            if (!Schema::hasColumn('countries', 'created_by')) {
                $table->unsignedBigInteger('created_by')->nullable();
                $table->foreign('created_by')->references('id')->on('users')->onDelete('NO ACTION');
            }

            if (!Schema::hasColumn('countries', 'updated_by')) {
                $table->unsignedBigInteger('updated_by')->nullable();
                $table->foreign('updated_by')->references('id')->on('users')->onDelete('NO ACTION');
            }
        });

        // Modificar la tabla "positions" 
        Schema::table('positions', function (Blueprint $table) {
            if (!Schema::hasColumn('positions', 'created_by')) {
                $table->unsignedBigInteger('created_by')->nullable();
                $table->foreign('created_by')->references('id')->on('users')->onDelete('NO ACTION');
            }

            if (!Schema::hasColumn('positions', 'updated_by')) {
                $table->unsignedBigInteger('updated_by')->nullable();
                $table->foreign('updated_by')->references('id')->on('users')->onDelete('NO ACTION');
            }
        });

        // Modificar la tabla "subjects" 
        Schema::table('subjects', function (Blueprint $table) {
            if (!Schema::hasColumn('subjects', 'created_by')) {
                $table->unsignedBigInteger('created_by')->nullable();
                $table->foreign('created_by')->references('id')->on('users')->onDelete('NO ACTION');
            }

            if (!Schema::hasColumn('subjects', 'updated_by')) {
                $table->unsignedBigInteger('updated_by')->nullable();
                $table->foreign('updated_by')->references('id')->on('users')->onDelete('NO ACTION');
            }
        });

        // Modificar la tabla "series" 
        Schema::table('series', function (Blueprint $table) {
            if (!Schema::hasColumn('series', 'created_by')) {
                $table->unsignedBigInteger('created_by')->nullable();
                $table->foreign('created_by')->references('id')->on('users')->onDelete('NO ACTION');
            }

            if (!Schema::hasColumn('series', 'updated_by')) {
                $table->unsignedBigInteger('updated_by')->nullable();
                $table->foreign('updated_by')->references('id')->on('users')->onDelete('NO ACTION');
            }
        });

        // Modificar la tabla "editions" 
        Schema::table('editions', function (Blueprint $table) {
            if (!Schema::hasColumn('editions', 'created_by')) {
                $table->unsignedBigInteger('created_by')->nullable();
                $table->foreign('created_by')->references('id')->on('users')->onDelete('NO ACTION');
            }

            if (!Schema::hasColumn('editions', 'updated_by')) {
                $table->unsignedBigInteger('updated_by')->nullable();
                $table->foreign('updated_by')->references('id')->on('users')->onDelete('NO ACTION');
            }
        });

        // Repetí el bloque anterior para todas las tablas relevantes
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //Schema::table('all_tables', function (Blueprint $table) {
        //
        //});
        // Revertir cambios en la tabla "users"
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'created_by')) {
                $table->dropForeign(['created_by']);
                $table->dropColumn('created_by');
            }

            if (Schema::hasColumn('users', 'updated_by')) {
                $table->dropForeign(['updated_by']);
                $table->dropColumn('updated_by');
            }
        });

        // Revertir cambios en la tabla "authors"
        Schema::table('authors', function (Blueprint $table) {
            if (Schema::hasColumn('authors', 'created_by')) {
                $table->dropForeign(['created_by']);
                $table->dropColumn('created_by');
            }

            if (Schema::hasColumn('authors', 'updated_by')) {
                $table->dropForeign(['updated_by']);
                $table->dropColumn('updated_by');
            }
        });

        // Revertir cambios en la tabla "books" 
        Schema::table('books', function (Blueprint $table) {
            if (Schema::hasColumn('books', 'created_by')) {
                $table->dropForeign(['created_by']);
                $table->dropColumn('created_by');
            }

            if (Schema::hasColumn('books', 'updated_by')) {
                $table->dropForeign(['updated_by']);
                $table->dropColumn('updated_by');
            }
        });



        // Revertir cambios en la tabla "publishers" 
        Schema::table('publishers', function (Blueprint $table) {
            if (Schema::hasColumn('publishers', 'created_by')) {
                $table->dropForeign(['created_by']);
                $table->dropColumn('created_by');
            }

            if (Schema::hasColumn('publishers', 'updated_by')) {
                $table->dropForeign(['updated_by']);
                $table->dropColumn('updated_by');
            }
        });


    
        // Revertir cambios en la tabla "countries"  
        Schema::table('countries', function (Blueprint $table) {
            if (Schema::hasColumn('countries', 'created_by')) {
                $table->dropForeign(['created_by']);
                $table->dropColumn('created_by');
            }

            if (Schema::hasColumn('countries', 'updated_by')) {
                $table->dropForeign(['updated_by']);
                $table->dropColumn('updated_by');
            }
        });


        // Revertir cambios en la tabla "positions"  
        Schema::table('positions', function (Blueprint $table) {
            if (Schema::hasColumn('positions', 'created_by')) {
                $table->dropForeign(['created_by']);
                $table->dropColumn('created_by');
            }

            if (Schema::hasColumn('positions', 'updated_by')) {
                $table->dropForeign(['updated_by']);
                $table->dropColumn('updated_by');
            }
        });


        // Revertir cambios en la tabla "subjects" 
        Schema::table('subjects', function (Blueprint $table) {
            if (Schema::hasColumn('subjects', 'created_by')) {
                $table->dropForeign(['created_by']);
                $table->dropColumn('created_by');
            }

            if (Schema::hasColumn('subjects', 'updated_by')) {
                $table->dropForeign(['updated_by']);
                $table->dropColumn('updated_by');
            }
        });


        // Revertir cambios en la tabla "series"  
        Schema::table('series', function (Blueprint $table) {
            if (Schema::hasColumn('series', 'created_by')) {
                $table->dropForeign(['created_by']);
                $table->dropColumn('created_by');
            }

            if (Schema::hasColumn('series', 'updated_by')) {
                $table->dropForeign(['updated_by']);
                $table->dropColumn('updated_by');
            }
        });


        // Revertir cambios en la tabla "editions" 
        Schema::table('editions', function (Blueprint $table) {
            if (Schema::hasColumn('editions', 'created_by')) {
                $table->dropForeign(['created_by']);
                $table->dropColumn('created_by');
            }

            if (Schema::hasColumn('editions', 'updated_by')) {
                $table->dropForeign(['updated_by']);
                $table->dropColumn('updated_by');
            }
        });


    }
};
