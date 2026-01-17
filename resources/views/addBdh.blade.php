<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Bendahara</title>
</head>
<body>
    <form action="{{ route('bdh.store') }}" method="POST">
        @csrf
        <input type="text" name="nama" placeholder="Nama Bendahara" required>
        <input type="text" name="alamat" placeholder="Alamat" required>
        <input type="text" name="telepon" placeholder="Telepon" required>
        <input type="text" name="email" placeholder="Email" required>
        <button type="submit">Submit</button>
    </form>
</body>
</html>