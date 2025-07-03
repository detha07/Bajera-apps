<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Laporan Transaksi Nasabah Bulan {{ $bulanIni }}/{{ $tahunIni }}</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      font-size: 12px;
      margin: 20px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }
    th, td {
      border: 1px solid #000;
      padding: 6px;
      text-align: center;
    }
    th {
      background-color: #f2f2f2;
    }
    h2, h4 {
      text-align: center;
      margin: 0;
    }
  </style>
</head>
<body>

  <h2>Laporan Transaksi Nasabah</h2>
  <h4>Bulan {{ $bulanIni }} Tahun {{ $tahunIni }}</h4>

  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>Tanggal</th>
        <th>Nama Nasabah</th>
        <th>Jenis Transaksi</th>
        <th>Jumlah</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($transaksi as $index => $trx)
        <tr>
          <td>{{ $index + 1 }}</td>
          <td>{{ \Carbon\Carbon::parse($trx->tanggal_transaksi)->format('d-m-Y') }}</td>
          <td>{{ $trx->user->name ?? '-' }}</td>
          <td>{{ ucfirst($trx->jenis_transaksi) }}</td>
          <td>
            Rp {{ number_format($trx->jumlah ?? 0, 0, ',', '.') }}
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>

</body>
</html>
