<?php

use Brick\Math\BigInteger;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Ramsey\Uuid\Type\Decimal;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('oder_detail', function (Blueprint $table) {
            $table->id();
            $table -> BigInteger('Oder_id') -> unsigned();
            $table -> BigInteger('Product_id')-> unsigned();
            $table -> integer('qty');
            $table -> Decimal('Price', 10,2);
            $table -> foreign('Oder_id') -> references('id') -> on('oder');
            $table -> foreign('Product_id') -> references('id') -> on('product');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('oder_detail');
    }
};
