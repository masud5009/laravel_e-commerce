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
            $table->integer('user_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('subcategory_id');
            $table->unsignedBigInteger('childcategory_id');
            $table->string('name');
            $table->string('slug');
            $table->string('brand')->nullable();
            $table->string('sku')->nullable();
            $table->string('unit')->nullable();
            $table->float('weight')->nullable();
            $table->string('barcode')->unique()->nullable();
            $table->json('tags')->nullable();
            $table->decimal('unit_price', 10, 2)->default(0.00);
            $table->dateTime('discount_date')->nullable();
            $table->decimal('discount_price', 10, 2)->default(0.00);
            $table->integer('quantity')->default(0);
            $table->json('color')->nullable();
            $table->json('attribute_values')->nullable();
            $table->text('description')->nullable();
            $table->boolean('free_shipping_status');
            $table->decimal('flat_rate', 10, 2)->default(0.00)->nullable();
            $table->boolean('cash_on_delivery_status');
            $table->integer('warning_quantity');
            $table->boolean('show_stock_quantity');
            $table->boolean('show_stock_text');
            $table->boolean('active_status');
            $table->boolean('trandy');
            $table->boolean('hide_stock');
            $table->boolean('featured');
            $table->boolean('todays_deal');
            $table->integer('shipping_day');
            $table->json('images')->nullable();
            $table->string('thumbnail')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('subcategory_id')->references('id')->on('subcategories')->onDelete('cascade');
            $table->foreign('childcategory_id')->references('id')->on('child_categories')->onDelete('cascade');
            $table->timestamps();
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
