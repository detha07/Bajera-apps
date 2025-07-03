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
            <a href="{{ url('/user') }}">Manajemen Transaksi</a>
          </li>
        </div>
      </div>
      <div class="py-2 py-md-0">
        <a href="{{ route('tarik.addt') }}" class="btn btn-round text-white" style="background-color: #498536; border-color: #498536;">Tarik Saldo</a>
      </div>
    </div>

    {{-- Alert Pesan --}}
    @if (Session::has('message'))
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ Session::get('message') }}',
        timer: 3000,
        showConfirmButton: false
      });
    });
  </script>
@endif

    <div class="card mb-4">
      <div class="card-header">
        <h5 class="mb-0">Riwayat Setor</h5>
      </div>
      <div class="card-body">
        <form action="{{ route('tarik') }}" method="GET" class="row g-3">
          <div class="col-md-4">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ request('tanggal') }}">
          </div>
          <div class="col-md-4">
            <label for="bulan" class="form-label">Bulan</label>
            <select name="bulan" id="bulan" class="form-select">
              <option value="">-- Pilih Bulan --</option>
              @for ($i = 1; $i <= 12; $i++)
              <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>
                {{ DateTime::createFromFormat('!m', $i)->format('F') }}
              </option>
              @endfor
            </select>
          </div>
          <div class="col-md-4">
            <label for="tahun" class="form-label">Tahun</label>
            <select name="tahun" id="tahun" class="form-select">
              <option value="">-- Pilih Tahun --</option>
              @for ($y = date('Y'); $y >= 2022; $y--)
              <option value="{{ $y }}" {{ request('tahun') == $y ? 'selected' : '' }}>
                {{ $y }}
              </option>
              @endfor
            </select>
          </div>
          <div class="col-12 d-flex gap-2">
            <button type="submit" class="btn btn-success w-100">Terapkan Filter</button>
            <a href="{{ route('tarik') }}" class="btn btn-outline-secondary w-100">Reset</a>
          </div>
        </form>
      </div>
    </div>
    {{-- Tabel Riwayat Penarikan --}}
    <div class="row">
      <div class="col-md-12">
        <div class="card">

          {{-- Header Tabel --}}
          <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title m-0">Riwayat Penarikan</h4>
          </div>

          {{-- Isi Tabel --}}
          <div class="card-body">
            <div class="table-responsive">
              <table id="daftaruser" class="display table table-striped table-hover">
                <thead class="table-light">
                  <tr>
                    <th>No</th>
                    <th>Nasabah</th>
                    <th>Total Penarikan</th>
                    <th>Jenis Transaksi</th>
                    <th>Tanggal Penarikan</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($transaksi as $item)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $item->user->name }}</td>
                      <td>Rp{{ number_format($item->jumlah_tarik, 0, ',', '.') }}</td>
                      <td>{{ ucfirst($item->jenis_transaksi) }}</td>
                      <td>{{ \Carbon\Carbon::parse($item->tanggal_transaksi)->format('d-m-Y') }}</td>
                      <td></td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="6" class="text-center">Belum ada data penarikan.</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-3">
              {{ $transaksi->links() }}
            </div>
          </div>

        </div>
      </div>
    </div>

  </div>
</div>
@endsection
