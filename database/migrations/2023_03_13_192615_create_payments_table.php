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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->dateTime('payment_date');
            $table->decimal('amount_paid',$precision = 10, $scale = 2);
            $table->decimal('missing_amount',$precision = 10, $scale = 2);
            $table->unsignedBigInteger('sales');

            $table->foreign('sales')
            ->references('id')
            ->on('sales')
            ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
