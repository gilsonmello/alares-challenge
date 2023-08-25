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
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('qty');
            $table->enum('measure', ['GIGA']);
            $table->string('slug');
            $table->enum('time_interval', ['MONTHLY', 'ANNUAL']);
            $table->decimal('price')->default(0);
            $table->boolean('is_better')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
