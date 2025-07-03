@extends('layouts.main')

@section('container')
<div class="container">
  <div class="page-inner">
    <div class="page-header">
      <h3 class="fw-bold mb-3">Edit Data Sampah</h3>
      <div class="breadcrumbs mb-3"> 
        <li class="nav-home">
          <a href="{{ url('/Dadmin') }}">
            <i class="icon-home"></i>
          </a>
        </li>
        <li class="separator"><i class="icon-arrow-right"></i></li>
        <li class="nav-item"><a href="{{ url('/sampah') }}">Manajemen Sampah</a></li>
        <li class="separator"><i class="icon-arrow-right"></i></li>
        <li class="nav-item">Edit Sampah</li>
      </div>
    </div>

    {{-- Tampilkan Error Validasi --}}
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    {{-- Form Edit Sampah --}}
    <form action="{{ url('/sampah/' . $sampah->id . '/update') }}" method="POST" enctype="multipart/form-data" class="row g-3">
      @csrf
      @method('PATCH')

      <div class="col-md-6">
        <label for="nama_sampah" class="form-label">Nama Sampah</label>
        <input type="text" class="form-control" id="nama_sampah" name="nama_sampah" value="{{ old('nama_sampah', $sampah->nama_sampah) }}">
      </div>

      <div class="col-md-6">
        <label for="jenis_sampah" class="form-label">Jenis Sampah</label>
        <select id="jenis_sampah" class="form-select" name="jenis_sampah">
          <option disabled>Choose...</option>
          <option value="Limbah Botol Kaca" {{ $sampah->jenis_sampah == 'Limbah Botol Kaca' ? 'selected' : '' }}>Limbah Botol Kaca</option>
          <option value="Limbah Plastik" {{ $sampah->jenis_sampah == 'Limbah Plastik' ? 'selected' : '' }}>Limbah Plastik</option>
          <option value="Limbah elektronik" {{ $sampah->jenis_sampah == 'Limbah elektronik' ? 'selected' : '' }}>Limbah elektronik</option>
        </select>
      </div>

      <div class="col-md-6">
        <label for="harga_sampah" class="form-label">Harga Sampah</label>
        <input type="text" class="form-control" id="harga_sampah" name="harga_sampah" value="{{ old('harga_sampah', $sampah->harga_sampah) }}">
      </div>

      <div class="col-md-6">
        <label for="keterangan" class="form-label">Keterangan</label>
        <input type="text" class="form-control" id="keterangan" name="keterangan" value="{{ old('keterangan', $sampah->keterangan) }}">
      </div>

      <div class="col-md-6">
        <label class="form-label">Foto Saat Ini</label><br>
        @if ($sampah->foto_sampah)
          <img src="{{ asset('storage/' . $sampah->foto_sampah) }}" width="120" alt="Foto Sampah">
        @else
          <p class="text-muted">Tidak ada foto.</p>
        @endif
      </div>

      <div class="col-md-6">
        <label for="foto_sampah" class="form-label">Ganti Foto (Opsional)</label>
        <input type="file" name="foto_sampah" class="form-control" id="foto_sampah">
      </div>

      <div class="col-12 d-flex justify-content-between">
      <a href="{{ route('sampah') }}" class="btn btn-round text-white" style="background-color: #498536; border-color: #498536;">Kembali</a>
      <button type="submit" class="btn btn-round text-white" style="background-color: #498536; border-color: #498536;">Update Data</button>
    </div>
    </form>
  </div>
</div>
@endsection
