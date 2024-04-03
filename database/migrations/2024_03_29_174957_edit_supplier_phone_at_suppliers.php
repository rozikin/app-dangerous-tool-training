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
        Schema::table('suppliers', function (Blueprint $table) {
            $table->string('supplier_npwp')->nullable()->change();;
            $table->string('supplier_address')->nullable()->change();;
            $table->string('supplier_city')->nullable()->change();;
            $table->string('supplier_nation')->nullable()->change();;
            $table->string('supplier_person')->nullable()->change();;
            $table->string('supplier_phone')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('suppliers', function (Blueprint $table) {
            //
        });
    }
};
