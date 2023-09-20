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
            $table->string('unit')->nullable();
            $table->json('tags')->nullable();
            $table->decimal('unit_price', 10, 2)->default(0.00);
            $table->dateTime('discount_date')->nullable();
            $table->decimal('discount_price', 10, 2)->default(0.00);
            $table->integer('quantity')->default(0);
            $table->json('color')->nullable();
            $table->json('attribute_values')->nullable();
            $table->text('description')->nullable();
            $table->boolean('free_shipping_status')->default(0);
            $table->boolean('flat_rate_status')->default(0);
            $table->decimal('flat_rate', 10, 2)->default(0.00);
            $table->boolean('cash_on_delivery_status')->default(0);
            $table->integer('warning_quantity')->nullable();
            $table->boolean('show_stock_quantity')->default(true);
            $table->boolean('show_stock_text')->default(0);
            $table->boolean('hide_stock')->default(0);
            $table->boolean('featured')->default(0);
            $table->boolean('todays_deal')->default(0);
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
