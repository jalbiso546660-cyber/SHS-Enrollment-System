<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up()
    {
        Schema::create('student_registration', function (Blueprint $table) {
            $table->id('RegistrationID');
            $table->string('FirstName', 50);
            $table->string('MiddleName', 50)->nullable();
            $table->string('LastName', 50);
            $table->date('DOB');
            $table->enum('Gender', ['Male', 'Female', 'Other']);
            $table->text('Address');
            $table->string('ContactNo', 15);
            $table->string('Email', 100)->unique();
            $table->enum('Strand', ['STEM', 'ABM', 'HUMSS']);
            $table->string('FatherFullName', 100);
            $table->string('MotherFullName', 100);
            $table->string('FatherContactNo', 15);
            $table->string('MotherContactNo', 15);
            
            
            $table->timestamp('application_date')->default(DB::raw('CURRENT_TIMESTAMP')); // When student submits
            $table->timestamp('approved_date')->nullable(); // When admin approves
            $table->timestamp('rejected_date')->nullable(); // When admin rejects
            $table->enum('current_status', ['Pending', 'Approved', 'Rejected'])
                  ->default('Pending'); // current status
        });
    }

    public function down()
    {
        Schema::dropIfExists('student_registration');
    }
};
