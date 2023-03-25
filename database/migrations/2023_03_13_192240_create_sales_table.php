<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Sale;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->dateTime('sale_date');
            $table->unsignedBigInteger('user_id');
            $table->enum('sale_status',[Sale::PENDING,Sale::PARTIALLYPAID,Sale::PAID])
                    ->default(Sale::PENDING);
            $table->decimal('total_amount', $precision = 10, $scale = 2);
            $table->decimal('amount_paid', $precision = 10, $scale = 2);

                    
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
        });
            
      
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
