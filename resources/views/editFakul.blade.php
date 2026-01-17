<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Fakultas</title>
</head>
<body>
    <form action="{{ route('fakul.update', $datafakul->id_fakultas) }}" method="POST">
        @csrf
        <h1>Ubah Fakultas {{ $datafakul->nama_fakultas }}</h1>
        <input type="text" name="nama_fakultas" value="{{ $datafakul->nama_fakultas }}" placeholder="Nama Fakultas" required>
        <button type="submit">Simpan</button>
    </form>
</body>
</html>