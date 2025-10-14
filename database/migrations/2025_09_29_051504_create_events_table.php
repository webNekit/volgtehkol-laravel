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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\EventFormat::class)->nullable()->constrained()->nullOnDelete();
            $table->string('title');
            $table->string('slug')->unique();

            $table->text('description')->nullable();
            $table->longText('content')->nullable();

            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();

            $table->string('direction')->nullable();
            $table->string('organizer')->nullable();
            $table->string('image')->nullable();

            $table->boolean('is_active')->default(false);
            $table->boolean('is_banner')->default(false);
            $table->boolean('is_slider')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
