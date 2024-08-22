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
        Schema::table('users', function (Blueprint $table) {
            // Add new columns after the 'id' column
            $table->string('first_name')->after('name');
            $table->string('middle_name')->after('first_name');
            $table->string('last_name')->after('middle_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('name')->after('id');

            // Drop the new columns
            $table->dropColumn(['first_name', 'middle_name', 'last_name']);
        });
    }
};
