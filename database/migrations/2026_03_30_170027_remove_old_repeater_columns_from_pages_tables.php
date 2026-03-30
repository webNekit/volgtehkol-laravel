<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn(['images', 'documents', 'links']);
        });

        Schema::table('module_pages', function (Blueprint $table) {
            $table->dropColumn(['images', 'files', 'links']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->json('images')->nullable();
            $table->json('documents')->nullable();
            $table->json('links')->nullable();
        });

        Schema::table('module_pages', function (Blueprint $table) {
            $table->json('images')->nullable();
            $table->json('files')->nullable();
            $table->json('links')->nullable();
        });
    }
};
