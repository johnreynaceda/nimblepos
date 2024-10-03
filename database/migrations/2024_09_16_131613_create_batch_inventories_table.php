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
        Schema::create('batch_inventories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inventory_stock_id');
            $table->string('batch_code');
            $table->double('stock_quantity');
            $table->date('expiration_date');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('batch_inventories');
    }
};
