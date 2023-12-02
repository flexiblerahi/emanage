<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('uuid', 500)->unique();
            $table->foreignId('customer_id')->constrained('customers');
            $table->foreignId('agent_id')->nullable()->constrained('user_details');
            $table->foreignId('shareholder_id')->constrained('user_details');
            $table->double('price')->default(0);
            $table->string('sector');
            $table->string('block');
            $table->string('road');
            $table->string('plot');
            $table->string('kata');
            $table->string('type')->comment('cash, emi');
            $table->json('commission')->comment('commission data will be comes from commission table data take which agent get how much commission');
            $table->date('date');
            $table->foreignId('entry')->constrained('user_details');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
