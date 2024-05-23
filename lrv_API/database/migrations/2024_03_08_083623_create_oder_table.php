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
        Schema::create('oder', function (Blueprint $table) {
            $table->id();
            $table -> bigInteger('Custome_id')-> unsigned();
            $table -> string('Oder_date');
            $table -> decimal('Total_price', 10,2);
            $table -> foreign('Custome_id') -> references('id')-> on ('customer');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('oder');
    }
};
