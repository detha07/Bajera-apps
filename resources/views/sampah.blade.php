@extends('layouts.main')

@section('container')
<div class="container">
  <div class="page-inner">

    {{-- Header & Breadcrumb --}}
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4 justify-content-between">
      <div class="page-header">
        <h3 class="fw-bold mb-3">Manajemen Sampah</h3>
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
            <a href="{{ url('/sampah') }}">Manajemen Sampah</a>
          </li>
        </div>
      </div>

      <div class="py-2 py-md-0">
        <a href="{{ url('/sampah/addsampah') }}" class="btn btn-round text-white" style="background-color: #498536; border-color: #498536;">Tambah Sampah</a>
      </div>
    </div>

    {{-- Alert Message --}}
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


    {{-- Tabel Data Sampah --}}
    <div class="row">
      <div class="col-md-12">
        <div class="card">

          {{-- Header Tabel --}}
          <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title m-0">Daftar Sampah</h4>
            <form method="GET" action="{{ route('sampah') }}" class="d-inline d-flex align-items-center">
                <label class="mb-0 me-2">
                  <span class="me-2">Search:</span>
                  <input type="search" name="ssampah" class="form-control form-control-sm d-inline-block w-auto" placeholder="Cari pengguna..." value="{{ request('ssampah') }}">
                </label>
                <button type="submit" class="btn btn-sm btn-primary me-2">Cari</button>
                <a href="{{ route('sampah') }}" class="btn btn-sm btn-outline-secondary">Reset</a>
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
                    <th style="width: 10%">Action</th>
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
                      <td>
                        <div class="form-button-action">
                          <a href="{{ url('sampah/'.$item->id.'/edits') }}" class="btn btn-link btn-primary btn-lg" data-bs-toggle="tooltip" title="Edit">
                            <i class="fa fa-edit"></i>
                          </a>
                          <a href="{{ url('sampah/'.$item->id.'/delete') }}"
                             onclick="return confirm('Apakah Anda yakin ingin menghapus data sampah ini?')"
                             class="btn btn-link btn-danger"
                             data-bs-toggle="tooltip"
                             title="Hapus">
                            <i class="fa fa-times"></i>
                          </a>
                        </div>
                      </td>
                    </tr>
                    @empty
                    <tr>
                    <td colspan="5" class="text-center">Belum ada data penarikan.</td>
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
