@extends('layouts.mainn')

@section('container')
<div class="container">
  <div class="page-inner">

    {{-- Header & Breadcrumb --}}
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4 justify-content-between">
      <div class="page-header">
        <h3 class="fw-bold mb-3">Daftar Sampah</h3>
        <div class="breadcrumbs mb-3">
          <li class="nav-home d-inline-block">
            <a href="{{ url('/Dadmin') }}">
              <i class="icon-home"></i>
            </a>
          </li>
        </div>
      </div>
    </div>

    {{-- Tabel Data Sampah --}}
    <div class="row">
      <div class="col-md-12">
        <div class="card">

          {{-- Header Tabel --}}
          <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title m-0">Daftar Sampah</h4>
            <form method="GET" class="d-inline">
              <div id="basic-datatables_filter" class="dataTables_filter">
                <label class="mb-0">
                  <span class="me-2">Search:</span>
                  <input type="search" name="ssampah" class="form-control form-control-sm d-inline-block w-auto" placeholder="Cari...">
                </label>
              </div>
            </form>
          </div>

          {{-- Body Tabel --}}
          <div class="card-body">
            <div class="table-responsive">
              <table id="listsampah" class="display table table-striped table-hover">
                <thead class="table-light">
                  <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Nama Sampah</th>
                    <th>Jenis Sampah</th>
                    <th>Harga</th>
                    <th>Keterangan</th>
                  </tr>
                </thead>

                <tbody>
                  @forelse ($data as $item)
                    <tr>
                      <td>{{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}</td>
                      <td>
                      @if ($item->foto_sampah)
                      <img src="{{ asset('storage/' . $item->foto_sampah) }}" alt="Foto Sampah" width="80">
                      @else
                      <span class="text-muted">Tidak ada foto</span>
                      @endif
                      </td>
                      <td>{{ $item->nama_sampah }}</td>
                      <td>{{ $item->jenis_sampah }}</td>
                      <td>Rp {{ number_format($item->harga_sampah, 0, ',', '.') }}</td>
                      <td>{{ $item->keterangan }}</td>
                    </tr>
                    @empty
                    <tr>
                    <td colspan="5" class="text-c   enter">Belum ada data penarikan.</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-3">
              {{ $data->links() }}
            </div>
          </div>

        </div>
      </div>
    </div>

  </div>
</div>
@endsection
