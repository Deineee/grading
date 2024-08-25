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
        Schema::create('subject', function (Blueprint $table) {
            $table->id(); // Primary key

            // Foreign key referencing the 'departments' table
            $table->foreignId('department_id')->constrained('department')->onDelete('cascade');

            // Course details
            $table->string('subject_name');
            $table->text('subject_description');
            $table->string('subject_code')->unique(); 
            $table->integer('credits')->unsigned(); 

            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subject');
    }
};
