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
        Schema::create('trainings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('employee_id');

            $table->foreignId('diklat_id')->constrained('diklats'); // Diklat ID
            $table->foreignId('diklat_sub_id')->nullable()->constrained('diklat_sub_ones'); // Subdiklat ID

            $table->string('training_name');
            $table->string('organizer');

            $table->string('certificate_number');
            $table->string('certificate_file')->nullable();

            $table->date('start_date');
            $table->date('end_date');
            $table->year('year');
            $table->integer('duration_hours');

            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('rejection_reason')->nullable();
            $table->text('notes')->nullable();


            $table->timestamps();

            // foreign key
            $table->foreign('employee_id')->references('uuid')->on('employees')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainings');
    }
};
