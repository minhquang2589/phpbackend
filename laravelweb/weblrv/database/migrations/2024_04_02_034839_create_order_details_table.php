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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table -> BigInteger('oder_id') -> unsigned();
            $table -> BigInteger('product_id')-> unsigned();
            $table -> BigInteger('payment_id')-> unsigned();
            $table -> BigInteger('deal_id')-> unsigned();
            $table -> integer('qty');
            $table -> Decimal('price', 9,3);
            $table -> foreign('oder_id') -> references('id') -> on('orders');
            $table -> foreign('product_id') -> references('id') -> on('products');
            $table -> foreign('payment_id') -> references('id') -> on('payments');
            $table -> foreign('deal_id') -> references('id') -> on('deals');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
