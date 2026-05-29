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
        Schema::create('subjects', function (Blueprint $table) {
            $table->id('SubjectID');
            $table->foreignId('StrandID');
            $table->string('name');
            $table->enum('Semester', ['1st Semester', '2nd Semester']);
            $table->string('School_Year');
            $table->enum('Grade_Level', ['Grade 11', 'Grade 12']);
            $table->string('description')->nullable();

            $table->foreign('StrandID')->references('StrandID')->on('strands')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};
