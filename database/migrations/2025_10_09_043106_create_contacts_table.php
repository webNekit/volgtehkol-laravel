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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\ContactDepartament::class)->constrained()->cascadeOnDelete();
            $table->string('title')->nullable();
            $table->string('type')->comment('phone, email, address, site и т.д.');
            $table->string('value');

            $table->boolean('is_active')->default(true);
            $table->boolean('is_header')->default(false);
            $table->boolean('is_footer')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
