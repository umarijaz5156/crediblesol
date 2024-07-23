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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('seller_account_id');
            $table->string('title');
            $table->text('description');
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->unsignedBigInteger('stock');
            $table->string('stock_metric');
            $table->unsignedBigInteger('price');
            $table->string('price_metric');
            $table->date('available_date');
            $table->boolean('approved')->default(false);
            $table->timestamps();

            $table->foreign('seller_account_id')->references('id')->on('seller_accounts')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
