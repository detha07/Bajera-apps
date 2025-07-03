<?php

namespace App\Http\Controllers;

use App\Models\transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class Dasboardcontroller extends Controller
{
    public function Dnasabah()
{
    $userId = Auth::id();

    // Data untuk grafik bulanan
    $dataPerBulan = Transaksi::selectRaw('MONTH(tanggal_transaksi) as bulan,
        SUM(CASE WHEN jenis_transaksi = "setor" THEN total_harga ELSE 0 END) as total_setor,
        SUM(CASE WHEN jenis_transaksi = "tarik" THEN jumlah_tarik ELSE 0 END) as total_tarik')->where('user_id', $userId)->groupBy('bulan')->orderBy('bulan')->get();

    $labels = [];
    $setorData = [];
    $tarikData = [];

    for ($i = 1; $i <= 12; $i++) {
        $labels[] = Carbon::create()->month($i)->translatedFormat('F');
        $bulanData = $dataPerBulan->firstWhere('bulan', $i);

        $setorData[] = $bulanData ? $bulanData->total_setor : 0;
        $tarikData[] = $bulanData ? $bulanData->total_tarik : 0;
    }

    // Hitung total berat setoran (berat semua transaksi jenis 'setor')
    $totalBerat = Transaksi::where('user_id', $userId)
                    ->where('jenis_transaksi', 'setor','tarik')
                    ->sum('berat');

    return view('Dnasabah', compact('labels', 'setorData', 'tarikData', 'totalBerat'));
}
}
