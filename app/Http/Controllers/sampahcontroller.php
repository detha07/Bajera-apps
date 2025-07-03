<?php

namespace App\Http\Controllers;

use session;
use App\Models\sampah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class sampahcontroller extends Controller
{
    function index(Request $request)
    {
        $ssampah = $request->ssampah;
        $sampah = sampah::where('nama_sampah', 'LIKE', '%'.$ssampah.'%')->orderBy('id', 'desc' )->paginate(5);
        return view('sampah', ['data' => $sampah]);
    }

    function add()
    {
      return view('addsampah');  
    }

public function create(Request $request)
{
    $request->validate([
        'nama_sampah.*' => 'required|string|max:255|distinct|unique:sampah,nama_sampah',
        'jenis_sampah.*' => 'required|string|max:255',
        'harga_sampah.*' => 'required|numeric',
        'keterangan.*' => 'nullable|string',
        'foto_sampah.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $count = count($request->nama_sampah);

    for ($i = 0; $i < $count; $i++) {
        $fotoPath = null;

        if ($request->hasFile("foto_sampah.$i")) {
            $fotoPath = $request->file("foto_sampah")[$i]->store('foto_sampah', 'public');
        }

        sampah::create([
            'nama_sampah' => $request->nama_sampah[$i],
            'jenis_sampah' => $request->jenis_sampah[$i],
            'harga_sampah' => $request->harga_sampah[$i],
            'keterangan' => $request->keterangan[$i] ?? null,
            'foto_sampah' => $fotoPath,
        ]);
    }

    session()->flash('message', 'Data sampah berhasil ditambahkan');
    return redirect()->route('sampah');
}


function edits($id)
{
    $sampah = sampah::findOrfail($id);
    return view('edits', ['sampah' => $sampah]);
}

function update(Request $request, $id)
{
    $request->validate([
        'nama_sampah' => 'required|string|max:255|unique:sampah,nama_sampah,' . $id . ',id',
        'jenis_sampah' => 'required|string|max:255', 
        'harga_sampah' => 'required|numeric',
        'keterangan' => 'nullable|string',
        'foto_sampah' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $sampah = sampah::findOrFail($id); // gunakan model, bukan DB langsung

    // Hapus foto lama jika diganti
    if ($request->hasFile('foto_sampah')) {
        if ($sampah->foto_sampah && Storage::disk('public')->exists($sampah->foto_sampah)) {
            Storage::disk('public')->delete($sampah->foto_sampah);
        }
        $sampah->foto_sampah = $request->file('foto_sampah')->store('foto_sampah', 'public');
    }

    $sampah->nama_sampah = $request->nama_sampah;
    $sampah->jenis_sampah = $request->jenis_sampah;
    $sampah->harga_sampah = $request->harga_sampah;
    $sampah->keterangan = $request->keterangan;
    $sampah->save();

    session()->flash('message', 'Sampah berhasil diupdate');
    return redirect()->route('sampah');
}

function delete($id)
{
    $sampah = sampah::findOrFail($id);

    if ($sampah->foto_sampah && Storage::disk('public')->exists($sampah->foto_sampah)) {
        Storage::disk('public')->delete($sampah->foto_sampah);
    }

    $sampah->delete();

    session()->flash('message', 'Sampah berhasil Dihapus');
    return redirect()->route('sampah');
}

function Daftars(Request $request)
    {
        // $ssampah = $request->ssampah;
        // $sampah = DB::table('sampah')->where('nama_sampah', 'LIKE', '%'.$ssampah.'%')->orderBy('id', 'desc' )->simplePaginate(5);
        
        // return view('sampah', ['data' => $sampah]);
        $ssampah = $request->ssampah;
        $sampah = sampah::where('nama_sampah', 'LIKE', '%'.$ssampah.'%')->orderBy('id', 'desc' )->paginate(5);
        return view('Daftars', ['data' => $sampah]);
    }

}
