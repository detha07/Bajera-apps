<?php

namespace App\Http\Controllers;

use App\Models\Sampah;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class TransaksiController extends Controller
{
    // Halaman daftar transaksi setor
    public function setor(Request $request)
{
    // Mulai query dengan relasi
    $query = Transaksi::with(['user', 'sampah'])
        ->where('jenis_transaksi', 'setor');

    // Filter berdasarkan tanggal
    if ($request->tanggal) {
        $query->whereDate('tanggal_transaksi', $request->tanggal);
    }

    // Filter berdasarkan bulan
    if ($request->bulan) {
        $query->whereMonth('tanggal_transaksi', $request->bulan);
    }

    // Filter berdasarkan tahun
    if ($request->tahun) {
        $query->whereYear('tanggal_transaksi', $request->tahun);
    }

    // Eksekusi query + paginate
    $transaksi = $query->latest()->paginate(5);

    return view('setor', compact('transaksi'));
}


    // Halaman form tambah setor
    public function add()
    {
        $users = User::where('role', 'nasabah')->get(); // Hanya nasabah
        $sampah = Sampah::all();
        $jenisSampah = $sampah->pluck('jenis_sampah')->unique();

        return view('addsetor', compact('users', 'sampah', 'jenisSampah'));
    }

    // Simpan data setor
    public function create(Request $request)
    {
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'sampah_id' => 'required|array',
        'sampah_id.*' => 'required|exists:sampah,id',
        'berat' => 'required|array',
        'berat.*' => 'required|numeric|min:0.1',
        'tanggal_transaksi' => 'required|date',
    ]);

    $totalSeluruh = 0;

    foreach ($request->sampah_id as $index => $sampahId) {
        $berat = $request->berat[$index];
        $sampah = Sampah::findOrFail($sampahId);
        $total = $sampah->harga_sampah * $berat;

        // Simpan transaksi untuk tiap baris
        Transaksi::create([
            'user_id' => $request->user_id,
            'sampah_id' => $sampahId,
            'berat' => $berat,
            'total_harga' => $total,
            'jenis_transaksi' => 'setor',
            'jumlah_tarik' => 0,
            'tanggal_transaksi' => $request->tanggal_transaksi,
        ]);

        $totalSeluruh += $total;
    }

    // Tambahkan total saldo ke user
    $user = User::find($request->user_id);
    $user->saldo += $totalSeluruh;
    $user->save();
    session()->flash('message', 'Penyetoran Sampah Berhasil:)');
    return redirect()->route('setor')->with('success', 'Transaksi setor berhasil disimpan.');
    }
    public function detail($id)
    {
    $transaksi = Transaksi::with(['user', 'sampah'])
                  ->where('jenis_transaksi', 'setor')
                  ->findOrFail($id);

    return view('detail', compact('transaksi'));
    }


    // ======================= FUNGSI PENARIKAN ============================

    // Halaman daftar penarikan
    public function tarik(Request $request)
{
    $query = Transaksi::with('user')
        ->where('jenis_transaksi', 'tarik');

    // Filter berdasarkan tanggal
    if ($request->tanggal) {
        $query->whereDate('tanggal_transaksi', $request->tanggal);
    }

    // Filter berdasarkan bulan
    if ($request->bulan) {
        $query->whereMonth('tanggal_transaksi', $request->bulan);
    }

    // Filter berdasarkan tahun
    if ($request->tahun) {
        $query->whereYear('tanggal_transaksi', $request->tahun);
    }

    // Ambil hasil akhir dan pagination
    $transaksi = $query->latest()->paginate(5);

    return view('tarik', compact('transaksi'));
}


    // Halaman form tarik saldo
    public function addt()
    {
        $users = User::where('role', 'nasabah')->get(); // Filter hanya nasabah
        return view('addtarik', compact('users'));
    }

    // Simpan data penarikan
    public function createt(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'jumlah_tarik' => 'required|numeric|min:1',
            'tanggal_transaksi' => 'required|date',
        ]);

        $user = User::findOrFail($request->user_id);

        if ($request->jumlah_tarik > $user->saldo) {
            return back()->with('error', 'Saldo tidak mencukupi untuk penarikan.');
        }

        // Simpan transaksi penarikan
        Transaksi::create([
            'user_id' => $request->user_id,
            'sampah_id' => null,
            'berat' => null,
            'total_harga' => null,
            'jumlah_tarik' => $request->jumlah_tarik,
            'jenis_transaksi' => 'tarik',
            'tanggal_transaksi' => $request->tanggal_transaksi,
        ]);

        // Kurangi saldo user
        $user->saldo -= $request->jumlah_tarik;
        $user->save();
        session()->flash('message', 'Penarikan Saldo Nasabah Berhasil:)');
        return redirect()->route('tarik')->with('success', 'Penarikan saldo berhasil disimpan.');
    }

    

    public function rsetor()
    {
        $user = Auth::user();

        $transaksi = \App\Models\Transaksi::where('user_id', $user->id)
            ->where('jenis_transaksi', 'setor')
            ->orderBy('tanggal_transaksi', 'desc')
            ->paginate(5);

        return view('rsetor', compact('transaksi'));
    }

    public function rsetordetail($id)
    {
        $user = Auth::user();

        $transaksi = \App\Models\Transaksi::with('sampah')
            ->where('id', $id)
            ->where('user_id', $user->id) // Cegah akses data milik user lain
            ->firstOrFail(); 

        return view('rsetordetail', compact('transaksi'));
    }

    public function rtarik()
    {
        $user = Auth::user();

        $transaksi = Transaksi::with('sampah')
            ->where('user_id', $user->id)
            ->where('jenis_transaksi', 'tarik')
            ->orderBy('tanggal_transaksi', 'desc')
            ->paginate(10); // bisa disesuaikan

        return view('rtarik', compact('transaksi'));
    }
    
}
