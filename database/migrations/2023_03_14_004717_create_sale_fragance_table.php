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
        Schema::create('sale_fragance', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sale_id')->references('id')->on('sales')->onDelete('cascade');
            $table->unsignedBigInteger('fragance_id')->references('id')->on('fragances')->onDelete('cascade');
            $table->integer('quantity_fragrance');
            $table->decimal('amount',$precision = 10, $scale = 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_fragance');
    }
};
