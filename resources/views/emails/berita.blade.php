<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $judul }}</title>
</head>
<body>
    <h2 style="color: #498536;">{{ $judul }}</h2>
    <p>{!! nl2br(e($konten)) !!}</p>
    <hr>
    <p style="font-size: 12px; color: #888;">Email ini dikirim otomatis oleh sistem Bank Sampah</p>
</body>
</html>
