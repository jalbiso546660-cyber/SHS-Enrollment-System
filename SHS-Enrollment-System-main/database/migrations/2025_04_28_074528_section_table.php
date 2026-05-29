<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->id('SectionID');
            $table->string('Section_Name');
            $table->string('description')->nullable();
            $table->foreignId('StrandID')->references('StrandID')->on('strands'); 
            $table->enum('Grade_Level', ['Grade 11', 'Grade 12']); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sections');
    }
};