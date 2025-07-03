<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\BeritaEmail;

class BeritaController extends Controller
{
    public function index()
{
    $beritas = Berita::latest()->paginate(5); // ambil semua berita
    return view('berita.index', compact('beritas')); // tampilkan ke halaman admin
}


    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
        ]);

        // Simpan ke database
        $berita = Berita::create([
            'judul' => $request->judul,
            'konten' => $request->konten,
        ]);

        // Kirim ke semua nasabah
        $users = User::where('role', 'nasabah')->get();

        foreach ($users as $user) {
            Mail::to($user->email)->send(new BeritaEmail($berita->judul, $berita->konten));
        }

        return redirect()->route('berita.index')->with('message', 'Berita berhasil ditambahkan.');
    }

    function delete($id)
{
    $berita = Berita::findOrFail($id);
    $berita->delete();

    session()->flash('message', 'Berita Berhasil Dihapus.');
    return redirect()->route('berita.index');

}
}
