<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Laporan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function laporanTransaksiNasabahPDF()
{
    $bulanIni = Carbon::now()->month;
    $tahunIni = Carbon::now()->year;

    // Ambil semua transaksi (setor dan tarik) untuk bulan & tahun ini
    $transaksi = Transaksi::with(['user', 'sampah'])
        ->whereMonth('tanggal_transaksi', $bulanIni)
        ->whereYear('tanggal_transaksi', $tahunIni)
        ->get();

    // Hitung jumlah berdasarkan jenis transaksi
    foreach ($transaksi as $trx) {
        $trx->jumlah = $trx->jenis_transaksi === 'tarik'
            ? $trx->jumlah_tarik
            : $trx->total_harga;
    }

    $pdf = Pdf::loadView('laporan.transaksi_pdf', compact('transaksi', 'bulanIni', 'tahunIni'))->setPaper('A4', 'landscape');

    return $pdf->download('laporan-transaksi-nasabah-' . $bulanIni . '-' . $tahunIni . '.pdf');
}

     public function index()
    {
        $transaksis = Transaksi::with('user')->latest()->paginate(5);
        return view('laporan.index', compact('transaksis'));
    }

    public function filter(Request $request)
    {
        $query = Transaksi::with('user');

        if ($request->filled('hari')) {
            $query->whereDate('created_at', $request->hari);
        }

        if ($request->filled('bulan')) {
            $query->whereMonth('created_at', $request->bulan);
        }

        if ($request->filled('tahun')) {
            $query->whereYear('created_at', $request->tahun);
        }

        $transaksis = $query->latest()->paginate(5);

        return view('laporan.index', compact('transaksis'));
    }
}
