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
        Schema::create('order_returns', function (Blueprint $table) {
          
            $table->unsignedBigInteger('order_payment_id')->primary();
            $table->string('motivation');
            $table->boolean('returned')->default(false);
            $table->timestamps();

            $table->foreign('order_payment_id')->references('id')->on('order_payments')
            ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_returns');
    }
};
