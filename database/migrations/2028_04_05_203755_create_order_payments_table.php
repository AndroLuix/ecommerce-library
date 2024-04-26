<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_payments', function (Blueprint $table) {
            $table->id();
        $table->unsignedBigInteger('order_id');
        $table->unsignedBigInteger('card_credit_id')->nullable();

        $table->boolean('mark')->nullable();
        $table->decimal('amount', 10, 2);
        $table->string('transaction_id');
        $table->boolean('reso')->default(false);
        $table->timestamps();

        $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        $table->foreign('card_credit_id')->references('id')->on('credit_cards')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_payments');
    }
};
