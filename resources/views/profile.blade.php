@extends('layouts.mainn')

@section('container')
<div class="container">
  <div class="page-inner">
    <div class="page-header">
      <h3 class="fw-bold mb-3">Profil Saya</h3>
      <div class="breadcrumbs mb-3">
        <li class="nav-home">
          <a href="{{ url('/nasabah/dashboard') }}">
            <i class="icon-home"></i>
          </a>
        </li>
        <li class="separator"><i class="icon-arrow-right"></i></li>
        <li class="nav-item">Profil</li>
      </div>
    </div>

    {{-- Tampilkan error validasi --}}
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    {{-- Tampilkan pesan sukses --}}
    @if (session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif

    {{-- Form Update Profil --}}
    <form action="{{ route('updateprofile') }}" method="POST" class="row g-3">
      @csrf
      @method('PATCH')

      <div class="col-md-6">
        <label for="name" class="form-label">Nama Lengkap</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', auth()->user()->name) }}" required>
      </div>

      <div class="col-md-6">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" value="{{ old('username', auth()->user()->username) }}" required>
      </div>

      <div class="col-md-6">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', auth()->user()->email) }}" required>
      </div>

      <div class="col-md-6">
  <label for="role" class="form-label">Role</label>
  <input type="text" class="form-control" id="role" name="role" value="nasabah" readonly>
</div>


      <div class="col-md-6">
        <label for="password" class="form-label">Password Baru (opsional)</label>
        <input type="password" class="form-control" id="password" name="password">
      </div>

      <div class="col-md-6">
        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
      </div>

      <div class="col-12">
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
      </div>
    </form>
  </div>
</div>
@endsection
