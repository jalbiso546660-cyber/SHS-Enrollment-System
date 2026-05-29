<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id('ScheduleID');
            $table->foreignId('RoomID');
            $table->foreignId('TeacherID');
            $table->foreignId('SubjectID');
            $table->foreignId('SectionID');
            $table->enum('Day', ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday']);
            $table->time('Start_Time');
            $table->time('End_Time');

            $table->foreign('SubjectID')->references('SubjectID')->on('subjects')->onDelete('cascade');
            $table->foreign('TeacherID')->references('TeacherID')->on('teachers')->onDelete('cascade');
            $table->foreign('SectionID')->references('SectionID')->on('sections')->onDelete('cascade');
            $table->foreign('RoomID')->references('RoomID')->on('rooms')->onDelete('cascade');
        });
        
        
    }

    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};