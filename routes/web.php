<?php

use Illuminate\Support\Facades\Auth;
use Monolog\Handler\SamplingHandler;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\usercontroller;
use App\Http\Controllers\sampahcontroller;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\transaksicontroller;
use App\Http\Controllers\Dasboardcontroller;
use App\Http\Controllers\BeritaController;
use App\Exports\TransaksiExport;
use Maatwebsite\Excel\Facades\Excel;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {return view('welcome');});

//route login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', function () {Auth::logout();request()->session()->invalidate();request()->session()->regenerateToken();return redirect('/login');
})->name('logout');
//route login end

//route register
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
//route register end

// Admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    //dasboard admin
    Route::get('/Dadmin', [UserController::class, 'indexDadmin'])->name('dadmin.index')->middleware('auth');
    //dasboard admin end

    //laporan
    Route::get('/laporan/setor/pdf', [LaporanController::class, 'laporanTransaksiNasabahPDF'])->name('laporan.setor.pdf');
    Route::get('/laporan/export', function () {return Excel::download(new TransaksiExport, 'laporan_transaksi.xlsx');})->name('laporan.export');
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/filter', [LaporanController::class, 'filter'])->name('laporan.filter');
    //laporan end

    //manajemen user
    Route::get('/user', [usercontroller::class, 'index'] )->name('user')->middleware('auth');
    Route::get('/user/add', [usercontroller::class, 'add'] )->middleware('auth');
    Route::post('/user/create', [usercontroller::class, 'create'] )->middleware('auth');
    Route::get('/user/{id}/editu', [UserController::class, 'editu'])->name('user.edit')->middleware('auth');
    Route::patch('/user/{id}/update', [usercontroller::class, 'update'])->middleware('auth');
    Route::get('/user/{id}/delete', [usercontroller::class, 'delete'])->middleware('auth');
    //manajemen user end

    //manajemen sampah
    Route::get('/sampah', [sampahcontroller::class, 'index'] )->name('sampah')->middleware('auth');
    Route::get('/sampah/addsampah', [sampahcontroller::class, 'add'] )->middleware('auth');
    Route::post('/sampah/create', [sampahcontroller::class, 'create'] )->middleware('auth');
    Route::get('/sampah/{id}/edits', [sampahcontroller::class, 'edits'])->name('sampah.edit')->middleware('auth');
    Route::patch('/sampah/{id}/update', [sampahcontroller::class, 'update'])->name('sampah.update')->middleware('auth');
    Route::get('/sampah/{id}/delete', [sampahcontroller::class, 'delete'])->middleware('auth');
    //manajemen sampah end

    //manajemen setor
    Route::get('/setor', [transaksicontroller::class, 'setor'] )->name('setor')->middleware('auth');
    Route::get('/setor/addsetor', [transaksiController::class, 'add'])->name('setor.add')->middleware('auth');
    Route::post('/setor/create', [transaksicontroller::class, 'create'])->name('setor.create')->middleware('auth');
    Route::get('/setor/{id}/detail', [transaksicontroller::class, 'detail'])->name('setor.detail');
    //manajemen user end

    //manajemen penarikan
    Route::get('/tarik', [transaksicontroller::class, 'tarik'] )->name('tarik')->middleware('auth');
    Route::get('/tarik/addtarik', [transaksiController::class, 'addt'])->name('tarik.addt')->middleware('auth');
    Route::post('/tarik/createt', [transaksicontroller::class, 'createt'] )->name('tarik.create')->middleware('auth');
    //manajemen penarikan end
    });

    //manajemen berita
    Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
    Route::get('/berita/create', [BeritaController::class, 'create'])->name('berita.create');
    Route::post('/berita', [BeritaController::class, 'store'])->name('berita.store');
    Route::get('/berita/{id}/delete', [BeritaController::class, 'delete'])->middleware('auth');
    //manajemen berita end

// Nasabah
Route::middleware(['auth', 'role:nasabah'])->group(function () {
    Route::get('/Dnasabah', [Dasboardcontroller::class, 'Dnasabah'] )->name('Dnasabah')->middleware('auth');
    Route::get('/Daftars', [sampahcontroller::class, 'Daftars'] )->name('Daftars')->middleware('auth');
    Route::get('/Rsetor', [transaksicontroller::class, 'Rsetor'] )->name('Rsetor')->middleware('auth');
    Route::get('/Rtarik', [transaksicontroller::class, 'Rtarik'] )->name('Rtarik')->middleware('auth');
    Route::get('/profile', [usercontroller::class, 'profile'])->name('profile');
    Route::patch('/profile/update', [usercontroller::class, 'updateprofile'])->name('updateprofile');
    Route::get('rsetor', [transaksiController::class, 'rsetor'])->name('rsetor')->middleware('auth');
    Route::get('/rsetor/rsetordetail/{id}', [transaksiController::class, 'rsetordetail'])->name('rsetordetail')->middleware('auth');
    Route::get('rtarik', [transaksiController::class, 'rtarik'])->name('rtarik')->middleware('auth');
});
