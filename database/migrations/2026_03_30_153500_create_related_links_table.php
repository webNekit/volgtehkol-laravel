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
        Schema::create('related_links', function (Blueprint $table) {
            $table->id();
            $table->morphs('linkable');
            $table->string('url'); // Сама ссылка
            $table->string('caption')->nullable();
            $table->boolean('is_visible')->default(true);
            $table->integer('sort')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('related_links');
    }
};
