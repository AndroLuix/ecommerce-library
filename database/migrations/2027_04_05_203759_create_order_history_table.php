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
        Schema::create('order_history', function (Blueprint $table) {
        
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('card_id');
            $table->boolean('reso')->default(0);
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->primary(['order_id','card_id']);

            $table->foreign('order_id')->references('id')->on('orders')->onUpdate('cascade');
            $table->foreign('card_id')->references('id')->on('credit_cards')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_history');
    }
};
