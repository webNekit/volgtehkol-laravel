<?php

use App\Enums\EducationLevel;
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
        Schema::table('special_categories', function (Blueprint $table) {
            $table->string('education_level')->default(EducationLevel::Spo->value)->after('title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('special_categories', function (Blueprint $table) {
            $table->dropColumn('education_level');
        });
    }
};
