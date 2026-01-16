<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Program Studi</title>
</head>
<body>
    <form action="{{ route('prodi.store') }}" method="POST">
        @csrf
        <input type="text" name="nama_prodi" placeholder="Nama Prorgam Studi" required>
        <button type="submit">Submit</button>
    </form>
</body>
</html>