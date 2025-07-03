@extends('layouts.main')

@section('container')
<div class="container">
  <div class="page-inner">
    <div class="page-header">
      <h3 class="fw-bold mb-3">Edit Data Pengguna</h3>
      <div class="breadcrumbs mb-3"> 
        <li class="nav-home">
          <a href="{{ url('/Dadmin') }}">
            <i class="icon-home"></i>
          </a>
        </li>
        <li class="separator"><i class="icon-arrow-right"></i></li>
        <li class="nav-item"><a href="{{ url('/user') }}">Manajemen Pengguna</a></li>
        <li class="separator"><i class="icon-arrow-right"></i></li>
        <li class="nav-item">Edit Pengguna</li>
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

    {{-- Form Edit User --}}
    <form action="{{ url('user/' . $user->id . '/update') }}" method="POST" class="row g-3">
      @csrf
      @method('PATCH')

      <div class="col-md-6">
        <label for="name" class="form-label">Nama Lengkap</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}">
      </div>

      <div class="col-md-6">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" value="{{ old('username', $user->username) }}">
      </div>

      <div class="col-md-6">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}">
      </div>

      <div class="col-md-6">
        <label for="role" class="form-label">Role</label>
        <select id="role" class="form-select" name="role">
          <option disabled>Choose...</option>
          <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
          <option value="nasabah" {{ $user->role == 'nasabah' ? 'selected' : '' }}>Nasabah</option>
        </select>
      </div>

      <div class="col-md-6">
        <label for="password" class="form-label">Password (opsional)</label>
        <input type="password" class="form-control" id="password" name="password">
      </div>

      <div class="col-md-6">
        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
      </div>

      <div class="col-12 d-flex justify-content-between">
      <a href="{{ route('user') }}" class="btn btn-round text-white" style="background-color: #498536; border-color: #498536;">Kembali</a>
      <button type="submit" class="btn btn-round text-white" style="background-color: #498536; border-color: #498536;">Update Data</button>
    </div>
    </form>
  </div>
</div>
@endsection
