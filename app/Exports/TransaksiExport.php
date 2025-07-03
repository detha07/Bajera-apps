<?php

namespace App\Exports;

use App\Models\Transaksi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TransaksiExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Transaksi::with('user')->get();
    }

    public function map($transaksi): array
    {
        $jumlah = $transaksi->jenis_transaksi === 'tarik'
            ? $transaksi->jumlah_tarik
            : $transaksi->total_harga;

        return [
            $transaksi->id,
            $transaksi->user->name ?? 'Tidak Ada',
            $transaksi->jenis_transaksi,
            $jumlah,
            $transaksi->tanggal_transaksi,
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Nasabah',
            'Jenis Transaksi',
            'Jumlah',
            'Tanggal Transaksi',
        ];
    }
}
