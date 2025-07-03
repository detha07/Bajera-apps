@extends('layouts.mainn')

@section('container')
<div class="container">
  <div class="page-inner">

    {{-- Header --}}
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4 justify-content-between">
      <div class="page-header">
        <h3 class="fw-bold mb-3">Riwayat Setor</h3>
      </div>
    </div>

    {{-- Alert Message --}}
    @if (Session::has('message'))
      <div class="alert alert-success">
        {{ Session::get('message') }}
      </div>
    @endif

    {{-- Tabel Riwayat Setor --}}
    <div class="row">
      <div class="col-md-12">
        <div class="card">

          <div class="card-header">
            <h4 class="card-title m-0">Riwayat Setoran Anda</h4>
          </div>

          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped table-hover">
                <thead class="table-light">
                  <tr>
                    <th>No</th>
                    <th>Total Setor</th>
                    <th>Jenis Transaksi</th>
                    <th>Tanggal Setor</th>
                    <th style="width: 10%">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($transaksi as $item)
                    <tr>
                      <td>{{ ($transaksi->currentPage() - 1) * $transaksi->perPage() + $loop->iteration }}</td>
                      <td>Rp{{ number_format($item->total_harga, 0, ',', '.') }}</td>
                      <td>{{ ucfirst($item->jenis_transaksi) }}</td>
                      <td>{{ \Carbon\Carbon::parse($item->tanggal_transaksi)->format('d-m-Y') }}</td>
                      <td>
                        <a href="{{ route('rsetordetail', $item->id) }}" class="btn btn-link btn-primary btn-sm" data-bs-toggle="tooltip" title="Detail">
                          <i class="fas fa-eye"></i>
                        </a>
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="5" class="text-center">Belum ada data setoran.</td>
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
