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
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table -> string('ProductName');
            $table -> bigInteger('ProductCateId') -> unsigned();
            $table -> foreign('ProductCateId') -> references('id') -> on('productcate');
            $table -> string('BrandName');
            $table -> decimal('Price',8,3);
            $table -> string('Image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
