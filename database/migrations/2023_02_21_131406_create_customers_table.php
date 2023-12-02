<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('account_id')->unique();
            $table->string('name')->nullable();
            $table->string('phone')->unique();
            $table->text('present_address')->nullable();
            $table->text('permanent_address')->nullable();
            $table->string('emergency_contact')->nullable();
            $table->string('occupation')->nullable();
            $table->json('parent_name')->nullable()->comment('father name, and mother name');
            $table->tinyInteger('status')->default(0);
            $table->string('image')->nullable();
            $table->foreignId('entry')->constrained('user_details');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
