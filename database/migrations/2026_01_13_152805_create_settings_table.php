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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_title')->nullable();
            $table->text('site_description')->nullable();
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->timestamps();
        });
        
        // Insert default settings record
        \DB::table('settings')->insert([
            'site_title' => 'INTRA studio',
            'site_description' => null,
            'logo' => null,
            'favicon' => null,
            'facebook_url' => null,
            'linkedin_url' => null,
            'instagram_url' => null,
            'address' => '1505 Barrington Street, Suite 100 - M03, Halifax, Nova Scotia, B3J 2A4 CANADA',
            'phone' => null,
            'email' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
