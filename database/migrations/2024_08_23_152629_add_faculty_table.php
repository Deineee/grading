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
        Schema::create('faculty', function (Blueprint $table) {
            $table->id();
            
            // Reference to the teacher's name and email from the users table
            $table->foreignId('user_id')->constrained('users');
            $table->string('name'); 
            $table->string('email'); 
            $table->string('status');

            // Reference to the semester
            $table->foreignId('semester_id')->constrained('semester');
            $table->string('semester_name'); 
            
            // Reference to the department
            $table->foreignId('department_id')->constrained('department');
            $table->string('department_name'); 
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faculty');
    }
};
