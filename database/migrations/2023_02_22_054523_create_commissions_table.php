<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('commissions', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('type')->comment('Booking Money = 0, Down Payment = 1, Installment = 2');
            $table->double('total')->default(0);
            $table->json('rank1')->nullable()->comment('hand1, hand2, hand3, shareholder');
            $table->json('rank2')->nullable()->comment('hand1, hand2, hand3, shareholder');
            $table->json('rank3')->nullable()->comment('hand1, hand2, hand3, shareholder');
            $table->foreignId('user_details_id')->constrained('user_details');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('commissions');
    }
};
