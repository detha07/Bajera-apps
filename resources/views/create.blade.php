@extends('layouts.main')

@section('container')
<div class="container mt-4">
  <h4>Buat Berita</h4>
  <form action="{{ route('berita.store') }}" method="POST">
    @csrf
    <div class="mb-3">
      <label for="judul" class="form-label">Judul</label>
      <input type="text" class="form-control" name="judul" required>
    </div>
    <div class="mb-3">
      <label for="konten" class="form-label">Isi Berita</label>
      <textarea class="form-control" name="konten" rows="6" required></textarea>
    </div>
    <div class="col-12 d-flex justify-content-between">
      <a href="/berita" class="btn btn-round text-white" style="background-color: #498536; border-color: #498536;">Kembali</a>
      <button type="submit" class="btn btn-round text-white" style="background-color: #498536; border-color: #498536;">Tambahkan</button>
    </div>
  </form>
</div>
@endsection