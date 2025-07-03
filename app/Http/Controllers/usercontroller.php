<?php

namespace App\Http\Controllers;

 // Tidak perlu mengimpor 'session' secara langsung seperti ini, bisa dihapus
 // Mungkin tidak terpakai di sini, bisa dihapus jika hanya mengelola user
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User; // Penting: Import model User Anda
use Illuminate\Support\Facades\Session; // Gunakan ini jika ingin mengimpor facade Session


class UserController extends Controller // Pastikan nama kelas sesuai konvensi (diawali huruf kapital)
{
    function index(Request $request)
    {
        // Untuk view 'user'
        $suser = $request->suser;
        $users = DB::table('users')->where('name', 'LIKE', '%'.$suser.'%')->orderBy('id', 'desc' )->paginate(5);
        return view('user', ['data' => $users]);
        return auth()->user();
    }

    function add()
    {
        return view('add');
    }

    function create(Request $request)
{
    // Validasi input
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'username' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
        'role' => 'required|in:admin,nasabah'
    ]);

    // Jika validasi gagal
    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

    // Simpan ke database
    DB::table('users')->insert([
        'name' => $request->name,
        'username' => $request->username,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => $request->role
    ]);

    Session::flash('message', 'User Telah Ditambahkan');
    return redirect()->route('user');
}
    // --- Tambahkan method baru ini untuk Dadmin ---
public function indexDadmin(Request $request)
{
    // Filter pencarian nama user dengan role 'nasabah'
    $suser = $request->suser;

    $users = DB::table('users')->where('role', 'nasabah')->where('name', 'LIKE', '%'.$suser.'%')->paginate(5);

    // Tambahkan kode berikut untuk hitung total nasabah:
    $totalNasabah = DB::table('users')->where('role', 'nasabah')->count();
    $totalSaldo = User::where('role', 'nasabah')->sum('saldo');
    
    // Jika ada data lain yang ingin kamu tampilkan (total setor, dll), bisa tambahkan di sini juga

    return view('Dadmin', compact('users', 'totalNasabah', 'totalSaldo'));
}

function editu($id)
{
    $users = DB::table('users')->where('id', $id)->first();

    if (!$users) {
        abort(404);
    }

    return view('editu', ['user' => $users]);
}

public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'username' => 'required|string|max:255|unique:users,username,' . $id,
        'email' => 'required|email|max:255|unique:users,email,' . $id,
        'password' => 'nullable|string|min:6|confirmed',
        'role' => 'required|string',
    ]);

    $user = User::findOrFail($id); // Pastikan pakai model User

    $user->name = $request->name;
    $user->username = $request->username;
    $user->email = $request->email;
    $user->role = $request->role;

    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    $user->save();

    session()->flash('message', 'User berhasil diupdate');
    return redirect()->route('user');
}


function delete($id)
{
    $users = User::findOrFail($id);
    $users->delete();

    session()->flash('message', 'User berhasil dihapus.');
    return redirect()->route('user');

}

public function profile()
    {
        return view('profile');
    }

    public function updateprofile(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|string',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('profile')->with('success', 'Profile berhasil diperbarui.');
    }
}