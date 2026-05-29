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
        Schema::create('students', function (Blueprint $table) {
        $table->id('StudentID'); 
        $table->foreignId('RegistrationID');
        $table->string('DOB');
        $table->enum('Gender', ['Male', 'Female', 'Other']);
        $table->string('Address');
        $table->string('ContactNo');
        $table->string('Email')->unique();
        $table->foreignId('StrandID');
        $table->string('GradeLevel');
        $table->foreignId('SectionID');
        
        
        $table->foreign('StrandID')->references('StrandID')->on('strands')->onDelete('cascade');
        $table->foreign('SectionID')->references('SectionID')->on('sections')->onDelete('cascade');
        $table->foreign('RegistrationID')->references('RegistrationID')->on('student_registration')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
