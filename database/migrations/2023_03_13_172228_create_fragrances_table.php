<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Fragance;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fragances', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('name')->unique();
            $table->decimal('bottle_contents_ml',$precision = 10, $scale = 2);
            $table->decimal('price',$precision = 10, $scale = 2);
            $table->enum('gender',[Fragance::FEMENINO, Fragance::MASCULINO]);
            $table->integer('quantity_stock');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fragance');
    }
};
