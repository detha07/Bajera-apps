<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailLogsTable extends Migration

{
  public function up()
{
    Schema::create('beritas', function (Blueprint $table) {
        $table->id();
        $table->string('judul');
        $table->text('konten');
        $table->timestamps();
    });
}


    public function down()
    {
        Schema::dropIfExists('mails');
    }
}
