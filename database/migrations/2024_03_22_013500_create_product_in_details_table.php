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
        Schema::create('product_in_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_in_id', false, true)->unsigned()->index();
            $table->bigInteger('product_id', false, true)->unsigned()->index();
            $table->string('po_number');
            $table->string('original_no')->nullable();
            $table->string('batch')->nullable();
            $table->string('roll')->nullable();
            $table->string('gw')->nullable();
            $table->string('nw')->nullable();
            $table->string('width')->nullable();
            $table->string('basic_gm2')->nullable();
            $table->string('qty');

            $table->timestamps();

            
            $table->foreign('product_in_id')
            ->references('id')
            ->on('product_ins')
            ->onUpdate('cascade')
            ->onDelete('restrict');

            $table->foreign('product_id')
            ->references('id')
            ->on('products')
            ->onUpdate('cascade')
            ->onDelete('restrict');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_in_details');
    }
};
