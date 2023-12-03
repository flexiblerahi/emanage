<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 500);
            $table->foreignId('category_id')->constrained('categories')->nullable();
            $table->foreignId('brand_id')->constrained('brands')->nullable();
            $table->string('sku', 500)->unique();
            $table->string('units')->nullable();
            $table->double('sell_price')->default(0);
            $table->string('image', 500)->nullable();
            $table->integer('alert_qty')->default(1);
            $table->double('tax')->default(0);
            $table->text('description')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->foreignId('entry')->constrained('users');  
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
