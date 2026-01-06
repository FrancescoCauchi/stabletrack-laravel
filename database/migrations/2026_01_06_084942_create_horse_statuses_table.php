<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Lookup table for statuses
        Schema::create('horse_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // e.g. Racing, Retired, Injured, Resting
            $table->timestamps();
        });

        // Add FK to horses
        Schema::table('horses', function (Blueprint $table) {
            $table->foreignId('horse_status_id')
                  ->nullable()
                  ->after('letrot_url')
                  ->constrained('horse_statuses')
                  ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('horses', function (Blueprint $table) {
            $table->dropConstrainedForeignId('horse_status_id');
        });

        Schema::dropIfExists('horse_statuses');
    }
};
