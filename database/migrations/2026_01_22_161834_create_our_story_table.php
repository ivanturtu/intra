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
        Schema::create('our_story', function (Blueprint $table) {
            $table->id();
            $table->text('intro')->nullable();
            $table->text('description')->nullable();
            $table->text('highlight')->nullable();
            $table->timestamps();
        });
        
        // Create initial record
        \DB::table('our_story')->insert([
            'intro' => null,
            'description' => null,
            'highlight' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('our_story');
    }
};
