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
        Schema::table('intra_studio_team_leads', function (Blueprint $table) {
            $table->string('full_resume')->nullable()->after('resume_link');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('intra_studio_team_leads', function (Blueprint $table) {
            $table->dropColumn('full_resume');
        });
    }
};
