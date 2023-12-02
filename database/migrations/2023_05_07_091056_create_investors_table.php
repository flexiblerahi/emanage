<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('investors', function (Blueprint $table) {
            $table->id();
            $table->string('account_id')->unique();
            $table->string('name')->nullable();
            $table->string('phone')->unique();
            $table->text('present_address')->nullable();
            $table->text('permanent_address')->nullable();
            $table->string('emergency_contact')->nullable();
            $table->string('occupation')->nullable();
            $table->foreignId('role')->constrained('roles')->default(6);
            $table->json('parent_name')->nullable()->comment('father name, and mother name');
            $table->tinyInteger('status')->default(0);
            $table->string('image')->nullable();
            $table->double('income')->default(0);
            $table->foreignId('reference_id')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('investors');
    }
};
