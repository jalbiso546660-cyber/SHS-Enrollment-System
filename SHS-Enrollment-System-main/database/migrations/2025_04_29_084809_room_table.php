<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id('RoomID');
            $table->string('Room_Number')->unique();
            $table->string('Building')->nullable();
            $table->string('Floor')->nullable();
            $table->enum('Room_Type', ['Classroom', 'Laboratory', 'Faculty Room', 'Other']);
            $table->foreignId('StrandID');
            $table->enum('Grade_Level', ['Grade 11', 'Grade 12']);
            $table->integer('Capacity')->nullable();
            $table->boolean('is_available')->default(true);

            $table->foreign('StrandID')->references('StrandID')->on('strands');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};