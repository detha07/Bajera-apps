@extends('layouts.mainn')

@section('container')
<div class="container">
  <div class="page-inner">

    {{-- Header dan Breadcrumb --}}
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4 justify-content-between">
      <div class="page-header">
        <h3 class="fw-bold mb-3">Manajemen Transaksi</h3>
        <div class="breadcrumbs mb-3">
          <li class="nav-home d-inline-block">
            <a href="{{ url('/Dnasabah') }}">
              <i class="icon-home"></i>
            </a>
          </li>
          <li class="separator d-inline-block mx-2">
            <i class="icon-arrow-right"></i>
          </li>
          <li class="nav-item d-inline-block">
            <a href="{{ url('/user') }}">Riwayat Transaksi</a>
          </li>
        </div>
      </div>
    </div>

    {{-- Tabel Riwayat Penarikan --}}
    <div class="row">
      <div class="col-md-12">
        <div class="card">

          {{-- Header Tabel --}}
          <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title m-0">Riwayat Penarikan</h4>
            <form method="GET" class="d-inline">
              <div id="basic-datatables_filter" class="dataTables_filter">
              </div>
            </form>
          </div>

          {{-- Isi Tabel --}}
          <div class="card-body">
            <div class="table-responsive">
              <table id="daftaruser" class="display table table-striped table-hover">
                <thead class="table-light">
                  <tr>
                    <th>No</th>
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
