<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Pembayaran</title>
</head>
<body>
    <form action="{{ route('pby.update', $pembayaran->id) }}" method="POST">
        @csrf
        <input type="date" value="{{ $pembayaran->tgl_pembayaran }}" name="tgl_pembayaran" placeholder="Tanggal Pembayaran" required>
        <input type="number" value="{{ $pembayaran->jumlah_pembayaran }}" name="jumlah_pembayaran" placeholder="Jumlah Pembayaran" required>
        <select class="border p-1" value="{{ $pembayaran->nim }}" name="nim" id="">
                @foreach ($mahasiswa as $mhs)
                    <option value="{{ $mhs->nim }}">
                        {{ $mhs->nim }} - {{ $mhs->nama }}
                    </option>
                @endforeach
            </select>
    
            <select class="border p-1" value="{{ $pembayaran->nip }}" name="nip" id="">
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