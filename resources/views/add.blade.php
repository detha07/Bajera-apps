@extends('layouts.main')

@section('container')
<div class="container">
 <div class="page-inner">
            <div class="page-header">
              <h3 class="fw-bold mb-3">Manajemen Pengguna</h3>
              <div class="breadcrumbs mb-3"> 
                <li class="nav-home">
                  <a href="{{ url('/Dadmin')}}">
                    <i class="icon-home"></i>
                  </a>
                </li>
                <li class="separator">
                  <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                  <a href="{{ url('/user')}}">Manajemen Pengguna</a>
                </li>
                <li class="separator">
                  <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                  <a href="{{ url('/user/add')}}">Add User</a>
                </li>
              </div>
            </div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (Session::has('error'))
    <div class="alert alert-danger">
        {{ Session::get('error') }}
    </div>
@endif

@if (Session::has('message'))
    <div class="alert alert-success">
        {{ Session::get('message') }}
    </div>
@endif


        <form action="{{ url('/user/create')}}" method="POST" class="row g-3">
            @csrf
<div class="col-md-6">
    <label for="nama_sampah" class="form-label">Nama</label>
    <input type="text" class="form-control" id="name" name="name" value="{{ old('name')}}">
  </div>
  <div class="col-md-6">
    <label for="nama_sampah" class="form-label">Username</label>
    <input type="text" class="form-control" id="username" name="username" value="{{ old('username')}}">
  </div>
  <div class="col-md-6">
    <label for="nama_sampah" class="form-label">Email</label>
    <input type="text" class="form-control" id="email" name="email" value="{{ old('email')}}">
  </div>
  <div class="col-6">
    <label for="harga_sampah" class="form-label">Password</label>
    <input type="text" class="form-control" id="password" name="password" value="{{ old('password')}}" >
  </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select name="role" class="form-select" required>
                            <option value="">-- Pilih Role --</option>
                            <option value="admin">Admin</option>
                            <option value="nasabah">Nasabah</option>
                        </select>
                    </div>
    <div class="col-12 d-flex justify-content-between">
  <a href="{{ route('user') }}" class="btn btn-round text-white" style="background-color: #498536; border-color: #498536;">Kembali</a>
  <button type="submit" class="btn btn-round text-white" style="background-color: #498536; border-color: #498536;">Tambahkan</button>
</div>

</form>
 </div>
</div>
@endsection