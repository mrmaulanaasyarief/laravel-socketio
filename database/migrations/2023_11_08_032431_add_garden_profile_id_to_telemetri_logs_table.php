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
        Schema::table('telemetri_logs', function (Blueprint $table) {
            // $table->unsignedBigInteger('garden_profile_id')->nullable();
            $table->foreignId('garden_profile_id')->after('klasifikasi')->constrained()->onDelete('cascade')->onUpdate('cascade')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('telemetri_logs', function (Blueprint $table) {
            $table->dropForeign('garden_profile_id');
        });
    }
};
