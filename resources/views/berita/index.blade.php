@extends('layouts.main')

@section('container')
<div class="container">
  <div class="page-inner">

    {{-- Header & Breadcrumb --}}
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4 justify-content-between">
      <div class="page-header">
        <h3 class="fw-bold mb-3">Manajemen Berita</h3>
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
            <a href="{{ url('/berita') }}">Manajemen Berita</a>
          </li>
        </div>
      </div>
      <div class="py-2 py-md-0">
        <a href="{{ url('/berita/create') }}" class="btn btn-round text-white" style="background-color: #498536; border-color: #498536;">Tambah Berita</a>
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
            <h4 class="card-title m-0">Daftar Berita</h4>
          </div>

          {{-- Body Tabel --}}
          <div class="card-body">
            <div class="table-responsive">
              <table id="listsampah" class="display table table-striped table-hover">
                <thead class="table-light">
                  <tr>
                    <th>Judul</th>
                    <th>Isi</th>
                    <th>Tanggal</th>
                    <th style="width: 10%">Action</th>
                  </tr>
                </thead>

                <tbody>
                  @forelse ($beritas as $berita)
                    <tr>
                    <td>{{ $berita->judul }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($berita->konten, 100) }}</td>
                    <td>{{ $berita->created_at->format('d M Y') }}</td>
                    <td>
                        <div class="form-button-action">
                          <a href="{{ url('berita/'.$berita->id.'/delete') }}"
                             onclick="return confirm('Apakah Anda yakin ingin menghapus berita ini?')"
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
                    <td colspan="5" class="text-center">Belum ada Berita</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-3">
              {{ $beritas->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
