<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateNullableFieldsOnTransaksiTable extends Migration
{
    public function up()
    {
        Schema::table('transaksi', function (Blueprint $table) {
            // Ubah 'sampah_id' menjadi nullable
            $table->unsignedBigInteger('sampah_id')->nullable()->change();

            // Ubah 'berat' menjadi nullable
            $table->decimal('berat', 8, 2)->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('transaksi', function (Blueprint $table) {
            // Kembalikan ke tidak nullable
            $table->unsignedBigInteger('sampah_id')->nullable(false)->change();
            $table->decimal('berat', 8, 2)->nullable(false)->change();
        });
    }
}

