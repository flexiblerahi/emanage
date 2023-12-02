<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('investments', function (Blueprint $table) {
            $table->id();
            $table->string('account_id', 500)->unique();
            $table->foreignId('investor_id')->constrained('investors')->cascadeOnDelete();
            $table->string('document')->nullable();
            $table->double('rate')->default(0);
            $table->double('duration')->default(0);
            $table->string('duration_in');
            $table->foreignId('entry')->constrained('user_details');
            $table->date('invest_at');
            $table->date('last_interest')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1=activate( get commission every month), 0 = deactive (not get any commission)');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('investments');
    }
};