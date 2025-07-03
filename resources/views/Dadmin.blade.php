@extends('layouts.main')

@section('container')
<div class="container">
  <div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
      <div>
        <h3 class="fw-bold mb-3">DASHBOARD</h3>
        <h6 class="op-7 mb-2">Selamat Datang Admin.</h6>
      </div>
    </div>

    {{-- Statistik --}}
    <div class="row">
      {{-- Total Nasabah --}}
      <div class="col-sm-6 col-md-6">
        <div class="card card-stats card-round">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-icon">
                <div class="icon-big text-center icon-primary bubble-shadow-small">
                  <i class="fas fa-users"></i>
                </div>
              </div>
              <div class="col col-stats ms-3 ms-sm-0">
                <div class="numbers">
                  <p class="card-category">TOTAL NASABAH</p>
                  <h4 class="card-title">{{ number_format($totalNasabah) }}</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      {{-- Total Saldo --}}
      <div class="col-sm-6 col-md-6">
        <div class="card card-stats card-round">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-icon">
                <div class="icon-big text-center icon-info bubble-shadow-small">
                  <i class="fas fa-money-bill-wave"></i>
                </div>
              </div>
              <div class="col col-stats ms-3 ms-sm-0">
                <div class="numbers">
                  <p class="card-category">TOTAL SALDO</p>
                  <h4 class="card-title">Rp. {{ number_format($totalSaldo, 0, ',', '.') }}</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> 
    {{-- end row statistik --}}

    {{-- Tabel Daftar Nasabah --}}
    <div class="row mt-4">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title m-0">Daftar Nasabah</h4>
            <div class="d-flex align-items-center gap-2">
              <form method="GET" action="{{ route('dadmin.index') }}" class="d-inline d-flex align-items-center">
                <label class="mb-0 me-2">
                  <span class="me-2">Search:</span>
                  <input type="search" name="suser" class="form-control form-control-sm d-inline-block w-auto" placeholder="Cari pengguna..." value="{{ request('suser') }}">
                </label>
                <button type="submit" class="btn btn-sm btn-primary me-2">Cari</button>
                <a href="{{ route('dadmin.index') }}" class="btn btn-sm btn-outline-secondary">Reset</a>
              </form>
            </div>
          </div>

          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped table-hover">
                <thead class="table-light">
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Saldo</th>
                    <th>Role</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($users as $user)
                    <tr>
                      <td>{{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}</td>
                      <td>{{ $user->name }}</td>
                      <td>{{ $user->username }}</td>
                      <td>{{ $user->email }}</td>
                      <td>Rp.{{ number_format($user->saldo, 0, ',', '.') }}</td>
                      <td>
                        <span class="badge bg-{{ $user->role == 'admin' ? 'primary' : 'success' }}">
                          {{ ucfirst($user->role) }}
                        </span>
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="6" class="text-center">Tidak ada data pengguna.</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
            <div class="mt-3">
              {{ $users->withQueryString()->links() }}
            </div>
          </div>
        </div>
      </div>
    </div> {{-- end tabel nasabah --}}

  </div>
</div>
@endsection
