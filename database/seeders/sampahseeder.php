<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class sampahseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('sampah')->insert([
            'nama_sampah' =>'Botol bir Draft',
            'jenis_sampah' => 'limbah kaca',
            'harga_sampah' => '200',
            'keterangan' => 'perbotol seharga 200',

        ]);

         DB::table('sampah')->insert([
            'nama_sampah' =>'plastik belanja',
            'jenis_sampah' => 'limbah plastik',
            'harga_sampah' => '2000',
            'keterangan' => '2000/kg',

        ]);
    }
}
