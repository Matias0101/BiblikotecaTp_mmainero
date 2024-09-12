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
        Schema::create('book_authors', function (Blueprint $table) {
            $table->id();
            // Definir claves foráneas en lugar de solo enteros
        $table->foreignId('book_id')->nullable()->constrained('books')->onDelete('cascade');
        $table->foreignId('author_id')->nullable()->constrained('authors')->onDelete('cascade');
        $table->foreignId('position_id')->nullable()->constrained('positions')->onDelete('set null');
       
            // $table->integer('book_id')->nullable();
            // $table->integer('author_id')->nullable();
            // $table->integer('position_id')->nullable();
            //$table->integer('publisher_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_authors');
    }
};
