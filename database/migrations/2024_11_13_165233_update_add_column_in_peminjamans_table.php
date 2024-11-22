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
        Schema::table('peminjamans', function (Blueprint $table) {
             // Hapus foreign key yang lama
             $table->dropForeign(['employee_id']);
             $table->dropForeign(['item_id']);
 
             // Tambahkan foreign key dengan pengaturan cascade
             $table->foreign('employee_id')
                 ->references('id')
                 ->on('employees')
                 ->onUpdate('cascade')
                 ->onDelete('cascade');
 
             $table->foreign('item_id')
                 ->references('id')
                 ->on('items')
                 ->onUpdate('cascade')
                 ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peminjamans', function (Blueprint $table) {
             // Hapus foreign key yang baru
             $table->dropForeign(['employee_id']);
             $table->dropForeign(['item_id']);
 
             // Kembalikan ke pengaturan foreign key sebelumnya
             $table->foreign('employee_id')
                 ->references('id')
                 ->on('employees')
                 ->onUpdate('cascade')
                 ->onDelete('restrict'); // Ubah ke nilai sebelumnya jika perlu
 
             $table->foreign('item_id')
                 ->references('id')
                 ->on('items')
                 ->onUpdate('cascade')
                 ->onDelete('restrict'); // Ubah ke nilai sebelumnya jika perlu
        });
    }
};
