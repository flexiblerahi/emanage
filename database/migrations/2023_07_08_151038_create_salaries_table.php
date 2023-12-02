<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_detail_id')->constrained('user_details');
            $table->foreignId('group_id')->nullable();
            $table->foreignId('type_id')->nullable()->constrained('salary_types');
            $table->text('other')->nullable();
            $table->string('monthly')->nullable();
            $table->foreignId('entry')->constrained('user_details');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('salaries');
    }
};
