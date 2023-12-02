<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('land_purchases', function (Blueprint $table) {
            $table->id();
            $table->string('land', 255)->nullable();
            $table->string('giver', 255)->nullable();
            $table->string('taker', 255)->nullable();
            $table->string('mouza')->nullable();
            $table->string('rs')->nullable();
            $table->string('sa')->nullable();
            $table->double('amount')->nullable();
            $table->foreignId('entry')->constrained('user_details');
            $table->string('document', 500)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('land_purchases');
    }
};
