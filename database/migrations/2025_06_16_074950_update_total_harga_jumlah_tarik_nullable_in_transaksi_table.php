<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTotalHargaJumlahTarikNullableInTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('transaksi', function (Blueprint $table) {
            $table->integer('total_harga')->nullable()->change();
            $table->integer('jumlah_tarik')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaksi', function (Blueprint $table) {
            $table->integer('total_harga')->nullable(false)->change();
            $table->integer('jumlah_tarik')->nullable(false)->change();
        });
    }
}
