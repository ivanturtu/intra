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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('main_image')->nullable();
            $table->string('title');
            $table->text('short_description')->nullable();
            $table->string('sector')->nullable();
            $table->string('client')->nullable();
            $table->string('location')->nullable();
            $table->year('year')->nullable();
            $table->text('quote')->nullable();
            $table->json('image_gallery')->nullable();
            $table->text('description')->nullable();
            $table->string('selected_image')->nullable();
            $table->json('team_members')->nullable(); // Array of objects with 2 fields each
            $table->string('category')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_published')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
