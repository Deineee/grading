
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
        Schema::create('subject_prerequisite', function (Blueprint $table) {
            $table->id();
            
            // Subject ID
            $table->foreignId('subject_id')->constrained('subjects')->onDelete('cascade');

            // Prerequisite Subject ID
            $table->foreignId('prerequisite_subject_id')->constrained('subjects')->onDelete('cascade')->nullable();

            $table->unique(['subject_id', 'prerequisite_subject_id']);
            
            $table->timestamps();

        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subject_prerequisite');
    }
};