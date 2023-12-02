<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->string('account_id')->nullable();
            $table->string('name')->index('name');
            $table->string('phone')->index('phone');
            $table->text('present_address')->nullable();
            $table->text('permanent_address')->nullable();
            $table->string('emergency_contact')->nullable();
            $table->string('occupation')->nullable();
            $table->foreignId('role')->constrained('roles')->comment('Depends On Roles');
            $table->json('parent_name')->nullable()->comment('father name, and mother name');
            $table->tinyInteger('status')->default(0);
            $table->string('image')->nullable();
            $table->double('income')->default(0)->comment('only agent and shareholder');
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_details');
    }
};
