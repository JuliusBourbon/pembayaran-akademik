<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Bendahara</title>
</head>
<body>
    <form action="{{ route('bdh.update', $bendahara->nip) }}" method="POST">
        @csrf
        <input type="text" value="{{ $bendahara->nama }}" name="nama" placeholder="Nama Bendahara" required>
        <input type="text" value="{{ $bendahara->alamat }}" name="alamat" placeholder="Alamat" required>
        <input type="text" value="{{ $bendahara->telepon }}" name="telepon" placeholder="Telepon" required>
        <input type="text" value="{{ $bendahara->email }}" name="email" placeholder="Email" required>
        <button type="submit">Submit</button>
    </form>
</body>
</html>