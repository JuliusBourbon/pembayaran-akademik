<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Fakultas</title>
</head>
<body>
    <form action="{{ route('fakul.store') }}" method="POST">
        @csrf
        <input type="text" name="nama_fakultas" placeholder="Nama Fakultas" required>
        <button type="submit">Submit</button>
    </form>
</body>
</html>