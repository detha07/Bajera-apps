<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveNamaNasabahFromTransaksisTable extends Migration
{
    public function up()
    {
        Schema::table('transaksi', function (Blueprint $table) {
            $table->dropColumn('nama_nasabah');
            $table->dropColumn('nama_sampah');
            $table->dropColumn('jenis_sampah');
            $table->dropColumn('harga_sampah');
        });
    }

    public function down()
    {
        Schema::table('transaksi', function (Blueprint $table) {
            $table->string('nama_nasabah')->nullable();
            $table->string('nama_sampah')->nullable();
            $table->string('jenis_sampah')->nullable();
            $table->integer('harga_sampah')->nullable();
        });
    }
}
