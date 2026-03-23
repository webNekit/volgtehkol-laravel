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
        Schema::table('category_documents', function (Blueprint $table) {
            $table->integer('order')->default(0)->after('id');
        });

        $categories = \App\Models\CategoryDocument::orderBy('created_at')->get();
        foreach ($categories as $index => $category) {
            \App\Models\CategoryDocument::where('id', $category->id)->update(['order' => $index + 1]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('category_documents', function (Blueprint $table) {
            $table->dropColumn('order');
        });
    }
};
