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
        Schema::table('magazine_articles', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
            $table->foreignId('magazine_category_id')->nullable()->constrained('magazine_categories')->onDelete('set null')->after('image_gallery');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('magazine_articles', function (Blueprint $table) {
            $table->dropForeign(['magazine_category_id']);
            $table->dropColumn('magazine_category_id');
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('set null');
        });
    }
};
