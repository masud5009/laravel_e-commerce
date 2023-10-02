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
        Schema::table('products', function (Blueprint $table) {
            $table->boolean('trandy')->default(false)->nullable();
            $table->unsignedBigInteger('childcategory_id')->nullable();
            $table->foreign('childcategory_id')->references('id')->on('child_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('trandy');
            $table->dropColumn('childcategory_id');
        });
    }
};
