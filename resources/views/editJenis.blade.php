<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Jenis Biaya</title>
</head>
<body>
    <form action="{{ route('jenis.update', $jenisbiaya->id) }}" method="POST">
        @csrf
        <input type="text" value="{{ $jenisbiaya->nama }}" name="nama" placeholder="Nama Jenis Biaya" required>
        <input type="number" value="{{ $jenisbiaya->jumlah_biaya }}" name="jumlah_biaya" placeholder="Jumlah Biaya" required>
        <button type="submit">Submit</button>
    </form>
</body>
</html>