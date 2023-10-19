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
        Schema::create('telemetri_logs', function (Blueprint $table) {
            $table->id();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('altitude')->nullable();
            $table->string('SoG')->nullable();
            $table->string('CoG')->nullable();
            $table->string('current')->nullable();
            $table->string('voltage')->nullable();
            $table->string('power')->nullable();
            $table->string('status')->nullable();
            $table->string('ax')->nullable();
            $table->string('ay')->nullable();
            $table->string('az')->nullable();
            $table->string('gx')->nullable();
            $table->string('gy')->nullable();
            $table->string('gz')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('telemetri_logs');
    }
};
