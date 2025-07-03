<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('sampah', function (Blueprint $table) {
        $table->string('foto_sampah')->nullable();
    });
}

public function down()
{
    Schema::table('sampah', function (Blueprint $table) {
        $table->dropColumn('foto_sampah');
    });
}
};
