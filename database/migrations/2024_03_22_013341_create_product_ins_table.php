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
        Schema::create('product_ins', function (Blueprint $table) {
            $table->id();
            $table->string('product_in_no');
            $table->bigInteger('supplier_id', false, true)->unsigned()->index();
            $table->string('reciver');

            $table->timestamps();

              $table->foreign('supplier_id')
            ->references('id')
            ->on('suppliers')
            ->onUpdate('cascade')
            ->onDelete('restrict');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_ins');
    }
};
