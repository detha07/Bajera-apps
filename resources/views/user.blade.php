@extends('layouts.main')

@section('container')
<div class="container">
  <div class="page-inner">

    {{-- Header dan Breadcrumb --}}
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4 justify-content-between">
      <div class="page-header">
        <h3 class="fw-bold mb-3">Manajemen Pengguna</h3>
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
            <a href="{{ url('/user') }}">Manajemen Pengguna</a>
          </li>
        </div>
      </div>

      <div class="py-2 py-md-0">
        <a href="{{ url('/user/add') }}" class="btn btn-round text-white" style="background-color: #498536; border-color: #498536;">Tambah Pengguna</a>
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


    {{-- Tabel Data Pengguna --}}
    <div class="row">
      <div class="col-md-12">
        <div class="card">

          {{-- Header Tabel --}}
          <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title m-0">Daftar Nasabah</h4>
            <form method="GET" action="{{ route('user') }}" class="d-inline d-flex align-items-center">
                <label class="mb-0 me-2">
                  <span class="me-2">Search:</span>
                  <input type="search" name="suser" class="form-control form-control-sm d-inline-block w-auto" placeholder="Cari pengguna..." value="{{ request('suser') }}">
                </label>
                <button type="submit" class="btn btn-sm btn-primary me-2">Cari</button>
                <a href="{{ route('user') }}" class="btn btn-sm btn-outline-secondary">Reset</a>
              </form>
          </div>

          {{-- Body Tabel --}}
          <div class="card-body">
            <div class="table-responsive">
              <table id="daftaruser" class="display table table-striped table-hover">
                <thead class="table-light">
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th style="width: 10%">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($data as $item)
                    <tr>
                      <td>{{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}</td>
                      <td>{{ $item->name }}</td>
                      <td>{{ $item->username }}</td>
                      <td>{{ $item->email }}</td>
                      <td>
                        <span class="badge bg-{{ $item->role == 'admin' ? 'primary' : 'success' }}">
                          {{ ucfirst($item->role) }}
                        </span>
                      </td>
                      <td>
                        <div class="form-button-action">
                          <a href="{{ route('user.edit', $item->id) }}" class="btn btn-link btn-primary btn-lg" data-bs-toggle="tooltip" title="Edit">
                            <i class="fa fa-edit"></i>
                          </a>
                          <a href="{{ url('user/'.$item->id.'/delete') }}"
                             onclick="return confirm('Apakah Anda yakin ingin menghapus data pegngguna ini?')"
                             class="btn btn-link btn-danger"
                             data-bs-toggle="tooltip"
                             title="Hapus">
                            <i class="fa fa-times"></i>
                          </a>
                        </div>
                      </td>
                    </tr>
                  @endforeach
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
