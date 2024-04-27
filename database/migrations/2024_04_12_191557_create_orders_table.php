<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            
            $table->unsignedBigInteger('book_id');
            $table->unsignedBigInteger('address_id');
            $table->integer('quantity')->default(1);
            $table->boolean('nel_carrello')->nullabel()->default(0); 
            // se è null significa che è stato spedito
            // se è true deve verificare l'admin per esegurie la spedizione
            $table->decimal('TotalPrice', 10, 2)->nullable(); // serve per prendere il prezzo per quantità
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
