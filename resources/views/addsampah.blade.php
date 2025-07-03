@extends('layouts.main')

@section('container')
<div class="container">
  <div class="page-inner">
    <div class="page-header">
      <h3 class="fw-bold mb-3">Manajemen Sampah</h3>
      <div class="breadcrumbs mb-3"> 
        <li class="nav-home">
          <a href="{{ url('/Dadmin') }}">
            <i class="icon-home"></i>
          </a>
        </li>
        <li class="separator"><i class="icon-arrow-right"></i></li>
        <li class="nav-item"><a href="{{ url('/sampah') }}">Manajemen Sampah</a></li>
        <li class="separator"><i class="icon-arrow-right"></i></li>
        <li class="nav-item"><a href="{{ url('/sampah/addsampah') }}">Add Sampah</a></li>
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

    {{-- Form Tambah Sampah --}}
    <form action="{{ url('/sampah/create') }}" method="POST" enctype="multipart/form-data" id="form-sampah">
      @csrf

      <div id="form-container">
        <div class="row g-3 border p-3 rounded mb-3 form-set position-relative">
          <div class="col-md-6">
            <label class="form-label">Sampah</label>
            <input type="text" class="form-control" name="nama_sampah[]" required>
          </div>

          <div class="col-md-6">
            <label class="form-label">Jenis Sampah</label>
            <select class="form-select" name="jenis_sampah[]" required>
              <option selected disabled>Pilih Jenis...</option>
              <option value="Plastik">Plastik</option>
              <option value="Kertas">Kertas</option>
              <option value="Logam">Logam</option>
              <option value="Botol Kaca">Botol Kaca</option>
              <option value="Lainnya">Lainnya</option>
            </select>
          </div>

          <div class="col-md-6">
            <label class="form-label">Harga Sampah</label>
            <input type="text" class="form-control" name="harga_sampah[]" required>
          </div>

          <div class="col-md-6">
            <label class="form-label">Keterangan</label>
            <input type="text" class="form-control" name="keterangan[]" required>
          </div>

          <div class="col-md-12">
            <label class="form-label">Foto Sampah</label>
            <input type="file" class="form-control" name="foto_sampah[]" required>
          </div>

          {{-- Tombol hapus baris --}}
          <div class="text-end mt-2">
            <button type="button" class="btn btn-sm btn-danger btn-remove-row">Hapus Kolom</button>
          </div>
        </div>
      </div>

      <div class="mb-3 d-flex gap-2">
        <button type="button" class="btn btn-outline-secondary" id="btn-add-row">+ Tambah Kolom</button>
      </div>

      <div class="col-12 d-flex justify-content-between">
      <a href="{{ route('sampah') }}" class="btn btn-round text-white" style="background-color: #498536; border-color: #498536;">Kembali</a>
      <button type="submit" class="btn btn-round text-white" style="background-color: #498536; border-color: #498536;">Tambahkan</button>
    </div>
    </form>
  </div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('btn-add-row').addEventListener('click', function () {
  const container = document.getElementById('form-container');
  const formSet = container.querySelector('.form-set');
  const clone = formSet.cloneNode(true);

  // Kosongkan input dan reset select
  clone.querySelectorAll('input').forEach(input => input.value = '');
  clone.querySelectorAll('select').forEach(select => select.selectedIndex = 0);

  container.appendChild(clone);
});

// Event delegation untuk tombol hapus baris
document.getElementById('form-container').addEventListener('click', function (e) {
  if (e.target.classList.contains('btn-remove-row')) {
    const allFormSets = document.querySelectorAll('.form-set');
    if (allFormSets.length > 1) {
      e.target.closest('.form-set').remove();
    } else {
      alert('Minimal satu kolom harus ada.');
    }
  }
});
</script>
@endpush
