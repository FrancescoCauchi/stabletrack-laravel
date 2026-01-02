<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
   public function up(): void
{
    Schema::create('horses', function (Blueprint $table) {
        $table->id();
        $table->foreignId('stable_id')->constrained()->cascadeOnDelete();
        $table->string('name');
        $table->string('slug')->unique();
        $table->string('breed')->nullable();
        $table->unsignedTinyInteger('age')->nullable();
        $table->text('notes')->nullable();
        $table->timestamps();
    });
}


    
    public function down(): void
    {
        Schema::dropIfExists('horses');
    }
};
