@extends('layouts.main')

@section('container')
<div class="container mt-4">
  <div class="page-inner">

    {{-- Header & Breadcrumb --}}
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4">
      <div class="page-header">
        <h3 class="fw-bold mb-2">lAPORAN</h3>
        <div class="breadcrumbs">
          <li class="nav-home d-inline-block">
            <a href="{{ url('/Dadmin') }}">
              <i class="icon-home"></i>
            </a>
          </li>
          <li class="separator d-inline-block mx-2">
            <i class="icon-arrow-right"></i>
          </li>
          <li class="nav-item d-inline-block">
            <a href="{{ url('/berita') }}">Laporan</a>
          </li>
        </div>
      </div>
    </div>

    {{-- Alert Message --}}
    @if (Session::has('message'))
      <div class="alert alert-success">
        {{ Session::get('message') }}
      </div>
    @endif

    {{-- Filter Card --}}
    <div class="card mb-4">
      <div class="card-header d-flex flex-column flex-md-row justify-content-between align-items-md-center">
        <h5 class="mb-2 mb-md-0">Filter Laporan Transaksi</h5>
        <div class="d-flex gap-2">
          <a href="{{ route('laporan.setor.pdf') }}" class="btn btn-danger">
            <i class="fas fa-file-pdf me-1"></i> Cetak PDF
          </a>
          <a href="{{ route('laporan.export') }}" class="btn btn-success">
            <i class="fas fa-file-excel me-1"></i> Cetak Excel
          </a>
        </div>
      </div>
      <div class="card-body">
        <form action="{{ route('laporan.filter') }}" method="GET" class="row g-3">
          <div class="col-md-4">
            <label class="form-label">Hari</label>
            <input type="date" name="hari" class="form-control">
          </div>
          <div class="col-md-4">
            <label class="form-label">Bulan</label>
            <select name="bulan" class="form-select">
              <option value="">-- Pilih Bulan --</option>
              @for ($i = 1; $i <= 12; $i++)
                <option value="{{ $i }}">{{ DateTime::createFromFormat('!m', $i)->format('F') }}</option>
              @endfor
            </select>
          </div>
          <div class="col-md-4">
            <label class="form-label">Tahun</label>
            <select name="tahun" class="form-select">
              <option value="">-- Pilih Tahun --</option>
              @for ($y = date('Y'); $y >= 2022; $y--)
                <option value="{{ $y }}">{{ $y }}</option>
              @endfor
            </select>
          </div>
          <div class="col-12 d-flex gap-2">
            <button type="submit" class="btn btn-success w-100">Filter</button>
            <a href="{{ route('laporan.index') }}" class="btn btn-outline-secondary w-100">Reset</a>
          </div>
        </form>
      </div>
    </div>

    {{-- Data Table --}}
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Daftar Transaksi</h5>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table id="listsampah" class="table table-striped table-bordered">
            <thead class="table-light">
              <tr>
                <th>Tanggal</th>
                <th>Nama Nasabah</th>
                <th>Jenis Transaksi</th>
                <th>Jumlah</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($transaksis as $t)
              <tr>
                <td>{{ $t->tanggal_transaksi }}</td>
                <td>{{ $t->user->name ?? 'Tidak ditemukan' }}</td>
                <td>{{ ucfirst($t->jenis_transaksi) }}</td>
                <td>
                  Rp {{ number_format($t->jenis_transaksi == 'tarik' ? $t->jumlah_tarik : $t->total_harga, 0, ',', '.') }}
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="4" class="text-center">Tidak ada data</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-3">
          {{ $transaksis->links() }}
        </div>
      </div>
    </div>

  </div>
</div>
@endsection
