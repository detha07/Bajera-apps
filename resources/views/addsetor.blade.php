@extends('layouts.main')

@section('container')
<div class="container">
  <div class="page-inner">
    <div class="page-header">
      <h3 class="fw-bold mb-3">Manajemen Transaksi</h3>
      <div class="breadcrumbs mb-3"> 
        <li class="nav-home">
          <a href="{{ url('/Dadmin') }}">
            <i class="icon-home"></i>
          </a>
        </li>
        <li class="separator">
          <i class="icon-arrow-right"></i>
        </li>
        <li class="nav-item">
          <a href="{{ url('/setor') }}">Manajemen Setor</a>
        </li>
        <li class="separator">
          <i class="icon-arrow-right"></i>
        </li>
        <li class="nav-item">
          <a href="{{ url('/setor/addsetor') }}">Add Setor</a>
        </li>
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

    {{-- Form Tambah Transaksi Setor --}}
    <form action="{{ route('setor.create') }}" method="POST">
      @csrf

      {{-- Nama Nasabah --}}
      <div class="mb-3">
        <label for="user_id" class="form-label">Nama Nasabah</label>
        <select name="user_id" id="user_id" class="form-select" required>
          <option selected disabled>Pilih Nasabah...</option>
          @foreach ($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }}</option>
          @endforeach
        </select>
      </div>

      <div id="sampah-container">
        {{-- Grup Input Sampah --}}
        <div class="sampah-group row g-3 border p-3 rounded mb-3">
          {{-- Jenis Sampah --}}
          <div class="col-md-4">
            <label class="form-label">Jenis Sampah</label>
            <select name="jenis_sampah[]" class="form-select jenis-sampah" required>
              <option selected disabled>Pilih Jenis Sampah...</option>
              @foreach ($jenisSampah as $jenis)
                <option value="{{ $jenis }}">{{ $jenis }}</option>
              @endforeach
            </select>
          </div>

          {{-- Nama Sampah --}}
          <div class="col-md-4">
            <label class="form-label">Sampah</label>
            <select name="sampah_id[]" class="form-select nama-sampah" required>
              <option selected disabled>Pilih Sampah...</option>
            </select>
          </div>

          {{-- Berat --}}
          <div class="col-md-3">
            <label class="form-label">Berat (kg) / Jumlah</label>
            <input type="number" name="berat[]" class="form-control berat-input" step="0.01" min="0.1" required>
          </div>

          {{-- Hapus Baris --}}
          <div class="col-md-1 d-flex align-items-end">
            <button type="button" class="btn btn-danger remove-sampah">×</button>
          </div>
        </div>
      </div>

      {{-- Tombol Tambah Kolom --}}
      <div class="mb-3">
        <button type="button" id="addRow" class="btn btn-secondary">+ Tambah Kolom</button>
      </div>

      {{-- Tanggal Transaksi --}}
      <div class="mb-3">
        <label for="tanggal_transaksi" class="form-label">Tanggal Transaksi</label>
        <input type="date" name="tanggal_transaksi" class="form-control" required>
      </div>

      {{-- Jenis Transaksi --}}
      <input type="hidden" name="jenis_transaksi" value="setor">

      {{-- Total Harga --}}
      <div class="mb-3">
        <label class="form-label">Total Harga</label>
        <input type="text" class="form-control" id="total_harga_display" readonly>
        <input type="hidden" name="total_harga" id="total_harga">
      </div>

      {{-- Submit --}}
      <div class="col-12 d-flex justify-content-between">
      <a href="{{ route('setor') }}" class="btn btn-round text-white" style="background-color: #498536; border-color: #498536;">Kembali</a>
      <button type="submit" class="btn btn-round text-white" style="background-color: #498536; border-color: #498536;">Setor Sampah</button>
    </div>
    </form>
  </div>
</div>

{{-- Script AJAX --}}
<script>
const semuaSampah = @json($sampah);

function attachEvents(group) {
  const jenisSelect = group.querySelector('.jenis-sampah');
  const namaSelect = group.querySelector('.nama-sampah');
  const beratInput = group.querySelector('.berat-input');

  jenisSelect.addEventListener('change', () => {
    const jenis = jenisSelect.value;
    namaSelect.innerHTML = '<option selected disabled>Pilih Nama Sampah...</option>';

    semuaSampah.forEach(item => {
      if (item.jenis_sampah === jenis) {
        const option = document.createElement('option');
        option.value = item.id;
        option.text = `${item.nama_sampah} (Rp${item.harga_sampah}/kg)`;
        option.setAttribute('data-harga', item.harga_sampah);
        namaSelect.appendChild(option);
      }
    });
  });

  group.querySelector('.remove-sampah').addEventListener('click', function () {
    const allGroups = document.querySelectorAll('.sampah-group');
    if (allGroups.length > 1) {
      group.remove();
      updateTotalHarga();
    } else {
      alert('Minimal satu kolom sampah harus ada.');
    }
  });

  beratInput.addEventListener('input', updateTotalHarga);
  namaSelect.addEventListener('change', updateTotalHarga);
}

function updateTotalHarga() {
  let total = 0;

  document.querySelectorAll('.sampah-group').forEach(group => {
    const namaSelect = group.querySelector('.nama-sampah');
    const beratInput = group.querySelector('.berat-input');
    const selected = namaSelect.options[namaSelect.selectedIndex];

    const harga = selected?.getAttribute('data-harga') ? parseFloat(selected.getAttribute('data-harga')) : 0;
    const berat = parseFloat(beratInput.value) || 0;
    total += harga * berat;
  });

  document.getElementById('total_harga_display').value = 'Rp' + total.toLocaleString('id-ID');
  document.getElementById('total_harga').value = total;
}

// Tambah Baris
document.getElementById('addRow').addEventListener('click', () => {
  const container = document.getElementById('sampah-container');
  const original = container.querySelector('.sampah-group');
  const clone = original.cloneNode(true);

  // Reset input
  clone.querySelectorAll('input').forEach(i => i.value = '');
  clone.querySelector('.nama-sampah').innerHTML = '<option selected disabled>Pilih Nama Sampah...</option>';
  container.appendChild(clone);
  attachEvents(clone);
});

// Pasang event awal
document.querySelectorAll('.sampah-group').forEach(group => attachEvents(group));
</script>
@endsection
