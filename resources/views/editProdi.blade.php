<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Program Studi</title>
</head>
<body>
    <form action="{{ route('prodi.update', $dataprodi->id_prodi) }}" method="POST">
        @csrf
        <h1>Ubah Prodi {{ $dataprodi->nama_prodi }}</h1>
        <input type="text" name="nama_prodi" value="{{ $dataprodi->nama_prodi }}" placeholder="Nama Progam Studi" required>
        <button type="submit">Simpan</button>
    </form>
</body>
</html>