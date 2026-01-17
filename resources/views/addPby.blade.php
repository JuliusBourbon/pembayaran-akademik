<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Pembayaran</title>
</head>
<body>
    <form action="{{ route('pby.store') }}" method="POST">
        @csrf
        <input type="date" name="tgl_pembayaran" placeholder="Tanggal Pembayaran" required>
        <input type="number" name="jumlah_pembayaran" placeholder="Jumlah Pembayaran" required>
        <select class="border p-1" name="nim" id="">
                @foreach ($mahasiswa as $mhs)
                    <option value="{{ $mhs->nim }}">
                        {{ $mhs->nim }} - {{ $mhs->nama }}
                    </option>
                @endforeach
            </select>
    
            <select class="border p-1" name="nip" id="">
                @foreach ($bendahara as $bdh)
                    <option value="{{ $bdh->nip }}">
                        {{ $bdh->nip }} - {{ $bdh->nama }}
                    </option>
                @endforeach
            </select>
        <button type="submit">Submit</button>
    </form>
</body>
</html>