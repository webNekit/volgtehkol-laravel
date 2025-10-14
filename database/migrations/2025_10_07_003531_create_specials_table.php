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
        Schema::create('specials', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\SpecialCategory::class)->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('code')->nullable();
            $table->string('level_max')->nullable();
            $table->string('level_middle')->nullable();
            $table->string('form')->nullable();
            $table->string('cost')->nullable();
            $table->text('description')->nullable();
            $table->longText('content')->nullable();
            $table->string('qualification')->nullable();
            $table->string('image')->nullable();
            $table->boolean('is_active')->default(false);
            $table->boolean('is_banner')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('specials');
    }
};
