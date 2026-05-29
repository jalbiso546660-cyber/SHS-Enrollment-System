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
        Schema::create('payments', function (Blueprint $table) {
            $table->id('PaymentID');
            $table->foreignId('RegistrationID');            
            $table->enum('Payment_Method',['Cash', 'GCash'] );
            $table->decimal('Amount', 8, 2)->nullable();
            $table->string('Reference_Number')->nullable();
            $table->string('receipt')->nullable();
            $table->timestamp('Payment_Date')->useCurrent();
            $table->enum('Status',['Pending', 'Completed', 'Rejected'])->default('Pending');
            
            $table->foreign('RegistrationID')->references('RegistrationID')->on('student_registration')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
