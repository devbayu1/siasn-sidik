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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique(); // UUID column
            $table->string('old_nip')->nullable();
            $table->string('nip')->unique();
            $table->string('name');
            $table->string('degree_prefix')->nullable();
            $table->string('degree_suffix')->nullable();
            $table->string('national_id')->unique();
            $table->string('birth_place');
            $table->date('birth_date');
            $table->enum('gender', ['MALE', 'FEMALE']);
            $table->string('religion');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('unit')->nullable();

            // Foreign keys
            $table->foreignId('institute_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('education_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('major_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
