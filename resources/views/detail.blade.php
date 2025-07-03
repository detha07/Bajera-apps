@extends('layouts.main')

@section('container')
<div class="container">
  <div class="page-inner">

    {{-- Header dan Breadcrumb --}}
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4 justify-content-between">
      <div class="page-header">
        <h3 class="fw-bold mb-3">Manajemen Transaksi</h3>
        <div class="breadcrumbs mb-3">
          <li class="nav-home d-inline-block">
            <a href="{{ url('/Dadmin') }}">
              <i class="icon-home"></i>
            </a>
          </li>
          <li class="separator d-inline-block mx-2">
            <i class="icon-arrow-right"></i>
          </li>
          <li class="nav-item d-inline-block">
            <a href="{{ url('/setor') }}">Manajemen Setor</a>
          </li>
          <li class="separator d-inline-block mx-2">
            <i class="icon-arrow-right"></i>
          </li>
          <li class="nav-item d-inline-block">
            <span>Detail Setor</span>
          </li>
        </div>
      </div>
    </div>

    {{-- Tabel Detail Setor --}}
    <div class="row">
      <div class="col-md-12">
        <div class="card">

          {{-- Header Tabel --}}
          <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title m-0">Detail Setor</h4>
          </div>

          {{-- Body Tabel --}}
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped table-hover">
                <thead class="table-light">
                  <tr>
                    <th>Nasabah</th>
                    <th>Jenis Sampah</th>
                    <th>Nama Sampah</th>
                    <th>Berat (kg)</th>
                    <th>Total Harga</th>
                    <th>Tanggal Transaksi</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>{{ $transaksi->user->name }}</td>
                    <td>{{ $transaksi->sampah->jenis_sampah }}</td>
                    <td>{{ $transaksi->sampah->nama_sampah }}</td>
                    <td>{{ $transaksi->berat }} kg</td>
                    <td>Rp{{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('d-m-Y') }}</td>
                  </tr>
                </tbody>
              </table>
            </div>

            {{-- Tombol Kembali --}}
            <div class="col-12 d-flex justify-content-between">
              <a href="{{ route('setor') }}" class="btn btn-round text-white" style="background-color: #498536; border-color: #498536;">Kembali</a>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection
