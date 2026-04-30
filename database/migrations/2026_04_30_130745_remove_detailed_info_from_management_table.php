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
        Schema::table('management', function (Blueprint $table) {
            $table->dropColumn(['education', 'work_experience', 'professional_development', 'honors']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('management', function (Blueprint $table) {
            $table->json('education')->nullable();
            $table->json('work_experience')->nullable();
            $table->json('professional_development')->nullable();
            $table->json('honors')->nullable();
        });
    }
};
