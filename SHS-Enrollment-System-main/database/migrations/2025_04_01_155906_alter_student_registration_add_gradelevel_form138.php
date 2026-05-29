<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('student_registration', function (Blueprint $table) {
            $table->enum('GradeLevel', ['Grade 11', 'Grade 12'])->after('Strand'); 
            $table->string('Form138')->after('GradeLevel'); 
        });
    }

    public function down(): void
    {
        Schema::table('student_registration', function (Blueprint $table) {
            $table->dropColumn(['GradeLevel', 'Form138']);
        });
    }
};

