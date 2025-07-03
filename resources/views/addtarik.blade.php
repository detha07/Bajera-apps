@extends('layouts.main')

@section('container')
<div class="container">
  <div class="page-inner">

    {{-- Header --}}
    <div class="page-header">
      <h3 class="fw-bold mb-3">Form Tarik Saldo</h3>
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
          <a href="{{ url('/tarik') }}">Manajemen Tarik</a>
        </li>
        <li class="separator">
          <i class="icon-arrow-right"></i>
        </li>
        <li class="nav-item">
          <a href="#">Tambah Penarikan</a>
        </li>
      </div>
    </div>

    {{-- Error Validation --}}
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    {{-- Form Penarikan Saldo --}}
    <form action="{{ route('tarik.create') }}" method="POST" class="row g-3">
      @csrf

      {{-- Nama Nasabah --}}
      <div class="col-md-6">
        <label for="user_id" class="form-label">Nama Nasabah</label>
        <select name="user_id" id="user_id" class="form-select" required>
          <option selected disabled>Pilih Nasabah...</option>
          @foreach ($users as $user)
            <option value="{{ $user->id }}" data-saldo="{{ $user->saldo }}">
              {{ $user->name }}
            </option>
          @endforeach
        </select>
      </div>

      {{-- Saldo --}}
      <div class="col-md-6">
        <label for="saldo" class="form-label">Saldo Saat Ini</label>
        <input type="text" class="form-control" id="saldo_display" readonly>
      </div>

      {{-- Tanggal Penarikan --}}
      <div class="col-md-6">
        <label for="tanggal_transaksi" class="form-label">Tanggal Penarikan</label>
        <input type="date" name="tanggal_transaksi" class="form-control" required>
      </div>

      {{-- Jumlah Penarikan --}}
      <div class="col-md-6">
        <label for="jumlah_tarik" class="form-label">Jumlah yang Ingin Ditarik (Rp)</label>
        <input type="number" name="jumlah_tarik" id="jumlah_tarik" class="form-control" step="100" min="0" required>
      </div>
      
      {{-- jenis_transaksi --}}
      <div class="col-md-6">
        <label class="form-label">Jenis Transaksi</label>
        <input type="text" class="form-control" value="tarik" disabled>
        <input type="hidden" name="jenis_transaksi" value="tarik">
      </div>

      {{-- Jenis Transaksi --}}
      <input type="hidden" name="jenis_transaksi" value="tarik">

      {{-- Submit --}}
      <div class="col-12 d-flex justify-content-between">
      <a href="{{ route('tarik') }}" class="btn btn-round text-white" style="background-color: #498536; border-color: #498536;">Kembali</a>
      <button type="submit" class="btn btn-round text-white" style="background-color: #498536; border-color: #498536;">Tarik Saldo</button>
    </div>
    </form>

  </div>
</div>

{{-- Script --}}
<script>
  const userSelect = document.getElementById('user_id');
  const saldoDisplay = document.getElementById('saldo_display');

  userSelect.addEventListener('change', function () {
    const selected = this.options[this.selectedIndex];
    const saldo = selected.getAttribute('data-saldo') || 0;
    saldoDisplay.value = 'Rp' + parseFloat(saldo).toLocaleString('id-ID');
  });
</script>
@endsection
