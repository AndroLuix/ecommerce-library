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
        if (!Schema::hasTable('books')) {
            Schema::create('books', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('category_id');
                $table->unsignedBigInteger('discount_id')->nullable();

                $table->string('title');
                $table->text('description');
                $table->string('author');
                $table->decimal('price', 8, 2);
                $table->integer('quantity');
                $table->string('image');

                $table->timestamps();
            
                $table->foreign('category_id')
                    ->references('id')
                    ->on('category_books')
                    ->onUpdate('cascade')->onUpdate('cascade');

                $table->foreign('discount_id')->references('id')->on('discounts')
                ->onDelete('set null');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
