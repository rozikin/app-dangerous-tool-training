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
            $table->string('product_code');
            $table->string('product_name');
            $table->string('product_spesification');
            $table->bigInteger('product_category_id', false, true)->unsigned()->index();
            $table->bigInteger('product_color_id', false, true)->unsigned()->index();
            $table->bigInteger('product_allocation_id', false, true)->unsigned()->index();
            $table->string('product_size');
            $table->string('product_group');
            $table->string('product_unit');
            $table->string('product_price');
            $table->integer('product_stock');
            $table->string('image');
            $table->timestamps();

            $table->foreign('product_category_id')
            ->references('id')
            ->on('category_products')
            ->onUpdate('cascade')
            ->onDelete('restrict');

            $table->foreign('product_color_id')
            ->references('id')
            ->on('colors')
            ->onUpdate('cascade')
            ->onDelete('restrict');

            $table->foreign('product_allocation_id')
            ->references('id')
            ->on('product_allocations')
            ->onUpdate('cascade')
            ->onDelete('restrict');
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
