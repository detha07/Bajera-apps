@extends('layouts.mainn')

@section('container')
<div class="container">
  <div class="page-inner">

    {{-- Header --}}
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
      <div>
        <h3 class="fw-bold mb-3">DASHBOARD</h3>
        <h6 class="op-7 mb-2">Selamat Datang, {{ Auth::user()->name }}.</h6>
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
                  <i class="fas fa-wallet"></i>
                </div>
              </div>
              <div class="col col-stats ms-3 ms-sm-0">
                <div class="numbers">
                  <p class="card-category">SALDO ANDA</p>
                  <h4 class="card-title">Rp {{ number_format(Auth::user()->saldo, 0, ',', '.') }}</h4>
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
                  <i class="fas fa-balance-scale"></i>
                </div>
              </div>
              <div class="col col-stats ms-3 ms-sm-0">
                <div class="numbers">
                  <p class="card-category">TOTAL BERAT SETORAN</p>
                  <h4 class="card-title">{{ $totalBerat }} Kg</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> {{-- end row statistik --}}
    <div class="card mt-4">
  <div class="card-header">
    <h5>Grafik Setoran & Penarikan per Bulan</h5>
  </div>
  <div class="card-body">
    <canvas id="grafikTransaksi"></canvas>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctx = document.getElementById('grafikTransaksi').getContext('2d');
  const grafikTransaksi = new Chart(ctx, {
    type: 'bar', // Ubah jadi 'line' jika ingin garis
    data: {
      labels: {!! json_encode($labels) !!},
      datasets: [
        {
          label: 'Saldo Masuk (Setor)',
          data: {!! json_encode($setorData) !!},
          backgroundColor: 'rgba(54, 162, 235, 0.6)',
          borderColor: 'rgba(54, 162, 235, 1)',
          borderWidth: 1
        },
        {
          label: 'Penarikan',
          data: {!! json_encode($tarikData) !!},
          backgroundColor: 'rgba(255, 99, 132, 0.6)',
          borderColor: 'rgba(255, 99, 132, 1)',
          borderWidth: 1
        }
      ]
    },
    options: {
      responsive: true,
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            callback: function(value) {
              return 'Rp ' + value.toLocaleString('id-ID');
            }
          }
        }
      }
    }
  });
</script>
  </div>
</div>
@endsection
