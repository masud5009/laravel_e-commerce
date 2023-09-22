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
            $table->string('name');
            $table->string('slug');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('subcategory_id')->nullable();
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
            $table->boolean('free_shipping_status')->default(0)->nullable();
            $table->decimal('flat_rate', 10, 2)->default(0.00)->nullable();
            $table->boolean('cash_on_delivery_status')->default(false)->nullable();
            $table->integer('warning_quantity')->default(false)->nullable();
            $table->boolean('show_stock_quantity')->default(false)->nullable();
            $table->boolean('show_stock_text')->default(false)->nullable();
            $table->boolean('hide_stock')->default(false)->nullable();
            $table->boolean('featured')->default(false)->nullable();
            $table->boolean('todays_deal')->default(false)->nullable();
            $table->integer('shipping_day')->nullable();
            $table->json('images')->nullable();
            $table->string('thumbnail')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('subcategory_id')->references('id')->on('subcategories')->onDelete('cascade');
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
