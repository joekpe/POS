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
            $table->string('name');
            $table->string('category');
            $table->foreignIdFor(\App\Models\Supplier::class, 'supplier_id')->nullable();
            $table->decimal('wholesale_price', $precision = 8, $scale = 2);
            $table->decimal('retail_price', $precision = 8, $scale = 2);
            $table->integer('quantity_stock');
            $table->integer('receiving_quantity');
            $table->integer('reorder_level');
            $table->text('description')->nullable();
            $table->string('avatar')->nullable()->default('product.jpg');
            $table->timestamps();
            $table->softDeletes();
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
