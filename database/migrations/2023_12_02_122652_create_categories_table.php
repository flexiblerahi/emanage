<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 500)->index('name');
            $table->string('image')->nullable();
            $table->string('sku', 500)->index('sku')->unique();
            $table->integer('parent_id')->default(0)->comment('category will be 0 and sub category will be category id');
            $table->foreignId('entry')->constrained('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
