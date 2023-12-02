<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('backup_investments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('investment_id')->constrained('investments');
            $table->foreignId('investor_id')->constrained('investors')->cascadeOnDelete();
            $table->string('document')->nullable();
            $table->double('rate')->default(0);
            $table->double('duration')->default(0);
            $table->string('duration_in');
            $table->text('comment')->nullable();
            $table->foreignId('entry')->constrained('user_details');
            $table->date('invest_at');
            $table->date('last_interest')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1 = activate( get commission every month), 0 = deactive (not get any commission)');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('backup_investments');
    }
};
