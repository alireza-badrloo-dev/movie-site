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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title_fa');
            $table->string('title_en')->nullable();
            $table->integer('year');
            $table->float('imdb_rate', 3, 1)->nullable();
            $table->string('duration')->nullable(); 
            $table->enum('type', ['movie', 'series' ,'animation' , 'documentary']);
            $table->text('summary')->nullable();
            $table->string('poster');
            $table->string('actors');
            $table->string('country')->nullable();
            $table->string('director')->nullable();
            $table->boolean('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
        
    }
};
